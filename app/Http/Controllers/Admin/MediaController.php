<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('mediable');

        // Filtre : Sans alt text
        if ($request->filter === 'no_alt') {
            $query->where(function ($q) {
                $q->whereNull('alt_text')
                  ->orWhere('alt_text', '');
            });
        }

        // Filtre : Par type de média
        if ($request->filter === 'product') {
            $query->where('mediable_type', 'App\Models\Product');
        }

        if ($request->filter === 'category') {
            $query->where('mediable_type', 'App\Models\Category');
        }

        if ($request->filter === 'collection') {
            $query->where('mediable_type', 'App\Models\Collection');
        }
        
        // Filtre : Orphelins
        if ($request->filter === 'orphan') {
            $query->whereDoesntHaveMorph('mediable', [
                'App\Models\Product',
                'App\Models\Category',
                'App\Models\Collection',
            ]);
        }

        // Filtre : Par rôle
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // Recherche par alt text ou nom de fichier
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('alt_text', 'like', "%{$search}%")
                  ->orWhere('path', 'like', "%{$search}%");
            });
        }

        $media = $query->orderBy('created_at', 'desc')
            ->paginate(30)
            ->withQueryString();

        // Stats
        $stats = [
            'total' => Media::count(),
            'missing_alt' => Media::whereNull('alt_text')
                ->orWhere('alt_text', '')
                ->count(),
            'orphans' => Media::whereDoesntHaveMorph('mediable', [
                'App\Models\Product',
                'App\Models\Category',
                'App\Models\Collection',
            ])->count(),
        ];

        return view('admin.media.index', compact('media', 'stats'));
    }

    public function update(Request $request, Media $medium)
    {
        $validated = $request->validate([
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $medium->update(['alt_text' => $validated['alt_text']]);

        return redirect()
            ->back()
            ->with('success', 'Texte alternatif mis à jour.');
    }

    public function destroy(Media $medium)
    {
        if ($medium->path && Storage::disk('public')->exists($medium->path)) {
            Storage::disk('public')->delete($medium->path);
        }

        $medium->delete();

        return redirect()
            ->back()
            ->with('success', 'Média supprimé avec succès.');
    }

    public function bulkUpdateAlt(Request $request)
    {
        $validated = $request->validate([
            'media_ids' => ['required', 'array'],
            'alt_texts' => ['required', 'array'],
            'alt_texts.*' => ['nullable', 'string', 'max:255'],
        ]);

        $count = 0;
        foreach ($validated['media_ids'] as $index => $mediaId) {
            $altText = $validated['alt_texts'][$index] ?? null;
            
            Media::where('id', $mediaId)->update(['alt_text' => $altText]);
            $count++;
        }

        return redirect()
            ->back()
            ->with('success', $count . ' textes alternatifs mis à jour.');
    }
}
