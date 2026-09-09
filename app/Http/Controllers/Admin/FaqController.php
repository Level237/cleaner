<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Http\Requests\Admin\FaqRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index()
    {
        $faqs = Faq::orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(15);

        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(FaqRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $data['order'] ?? 0;

        Faq::create($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question FAQ ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $data['order'] ?? 0;

        $faq->update($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question FAQ mise à jour avec succès.');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Question FAQ supprimée avec succès.');
    }
}
