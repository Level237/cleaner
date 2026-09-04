<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'products');
        
        $items = [];
        if ($type === 'products') {
            $items = Product::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        } elseif ($type === 'categories') {
            $items = Category::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        } elseif ($type === 'collections') {
            $items = Collection::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        }

        return view('admin.archives.index', compact('items', 'type'));
    }

    public function restore($type, $id)
    {
        $model = $this->getModelInstance($type, $id);
        
        if ($model) {
            $model->restore();
            return redirect()->back()->with('success', 'Élément restauré avec succès.');
        }

        return redirect()->back()->with('error', 'Élément introuvable.');
    }

    public function forceDelete($type, $id)
    {
        $model = $this->getModelInstance($type, $id);
        
        if ($model) {
            // Delete physical images based on model type
            if ($type === 'categories') {
                if ($model->image_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($model->image_path);
                }
                if ($model->og_image_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($model->og_image_path);
                }
            } elseif ($type === 'collections') {
                if ($model->og_image_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($model->og_image_path);
                }
                $model->products()->detach();
            } elseif ($type === 'products') {
                if ($model->og_image_path) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($model->og_image_path);
                }
                foreach ($model->media as $media) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($media->path);
                }
                $model->media()->delete();
            }

            $model->forceDelete();
            return redirect()->back()->with('success', 'Élément supprimé définitivement.');
        }

        return redirect()->back()->with('error', 'Élément introuvable.');
    }

    private function getModelInstance($type, $id)
    {
        switch ($type) {
            case 'products':
                return Product::onlyTrashed()->find($id);
            case 'categories':
                return Category::onlyTrashed()->find($id);
            case 'collections':
                return Collection::onlyTrashed()->find($id);
            default:
                return null;
        }
    }
}
