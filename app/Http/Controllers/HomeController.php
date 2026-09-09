<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        View::share('seoTitle', 'Cleaner — Thés bien-être détox, minceur & énergie');
        View::share('seoDescription', 'Découvrez Cleaner, votre maison de thés bien-être d\'exception. Thés détox, infusions minceur, énergie et relaxation 100% naturelles pour votre rituel quotidien.');
        View::share('seoImage', asset('assets/home.png'));

        // Fetch categories with their main image for the categories section
        $featuredCategories = Category::with('mainImage')->get();
        
        // Best-sellers = produits mis en avant (is_featured)
        $bestSellers = Product::published()
            ->with('mainImage')
            ->featured()
            ->take(4)
            ->get();

        // Fallback si aucun produit featured
        if ($bestSellers->isEmpty()) {
            $bestSellers = Product::published()
                ->with('mainImage')
                ->take(4)
                ->get();
        }

        return view('welcome', compact('featuredCategories', 'bestSellers'));
    }
}
