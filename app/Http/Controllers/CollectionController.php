<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::visible()->get();
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

        return view('collections.show', compact('collection', 'products'));
    }
}
