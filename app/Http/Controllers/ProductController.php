<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['media', 'variants'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
