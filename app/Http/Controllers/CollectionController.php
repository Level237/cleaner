<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Support\Facades\View;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::visible()->get();

        View::share('seoTitle', 'Nos Collections de Thés & Infusions Bien-être | ' . config('app.name'));
        View::share('seoDescription', 'Découvrez nos collections thématiques : Détox & Ventre Plat, Énergie & Vitalité, Relaxation & Sommeil. Des rituels sur-mesure pour votre corps.');
        View::share('seoImage', asset('assets/maison.png'));

        return view('collections.index', compact('collections'));
    }

    public function show($slug)
    {
        $collection = Collection::where('slug', $slug)
            ->visible()
            ->firstOrFail();

        // Paginate products for the collection
        $products = $collection->products()
            ->published()
            ->with(['media', 'variants'])
            ->paginate(12);

        View::share('seoModel', $collection);
        View::share('seoTitle', $collection->seo_title ?: $collection->name . ' — Collection Exclusive | ' . config('app.name'));
        View::share('seoDescription', $collection->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($collection->description), 155));
        if ($collection->image_path) {
            View::share('seoImage', asset('storage/' . $collection->image_path));
        }

        return view('collections.show', compact('collection', 'products'));
    }
}
