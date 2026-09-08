<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\Category::visible()->get();
        
        $query = Product::with(['media', 'variants'])->published();
        
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('primaryCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $products = $query->paginate(12)->withQueryString();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['media', 'variants'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
