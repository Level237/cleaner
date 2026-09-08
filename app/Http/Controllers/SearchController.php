<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search.index', [
                'query' => '',
                'products' => collect(),
                'categories' => collect(),
                'collections' => collect(),
            ]);
        }

        // Search Products
        $products = Product::published()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%");
            })
            ->with(['media', 'variants'])
            ->get();

        // Search Categories
        $categories = Category::visible()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        // Search Collections
        $collections = Collection::visible()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'products' => $products,
                'categories' => $categories,
                'collections' => $collections,
            ]);
        }

        return view('search.index', compact('query', 'products', 'categories', 'collections'));
    }
}
