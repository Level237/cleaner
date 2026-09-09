<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Support\Facades\View;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::visible()->get();

        View::share('seoTitle', 'Nos Collections | ' . config('app.name'));

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

        return view('collections.show', compact('collection', 'products'));
    }
}
