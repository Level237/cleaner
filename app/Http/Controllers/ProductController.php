<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

        View::share('seoTitle', 'Boutique — Tous nos thés bien-être & accessoires | ' . config('app.name'));
        View::share('seoDescription', 'Explorez l\'intégralité de nos thés bien-être, mélanges détox, infusions minceur et accessoires de dégustation. Ingrédients 100% naturels.');
        View::share('seoImage', asset('assets/hero1.png'));
        
        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['media', 'variants', 'reviews', 'mainImage'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        View::share('seoModel', $product);
        View::share('seoTitle', $product->seo_title ?: $product->name . ' — Thés Bien-être | ' . config('app.name'));
        View::share('seoDescription', $product->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($product->short_description ?: $product->description), 155));
        if ($product->mainImage?->file_path) {
            View::share('seoImage', asset('storage/' . $product->mainImage->file_path));
        }

        return view('products.show', compact('product'));
    }

    public function storeReview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->published()->firstOrFail();

        $validated = $request->validate([
            'reviewer_name'  => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'rating'         => 'required|integer|min:1|max:5',
            'comment'        => 'required|string|max:2000',
        ]);

        $product->reviews()->create([
            'user_id'        => auth()->id(),
            'reviewer_name'  => $validated['reviewer_name'],
            'reviewer_email' => $validated['reviewer_email'],
            'rating'         => $validated['rating'],
            'comment'        => $validated['comment'],
            'is_approved'    => true,
        ]);

        return back()->with('success', 'Votre avis a été publié avec succès. Merci !');
    }
}
