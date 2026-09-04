<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques Globales
        $stats = [
            'total_products' => Product::count(),
            'published_products' => Product::where('status', 'published')->count(),
            'draft_products' => Product::where('status', 'draft')->count(),
            'total_categories' => Category::count(),
            'total_collections' => Collection::count(),
            'total_variants' => ProductVariant::count(),
        ];

        // 2. Alertes SEO & Qualité (Le cœur du réacteur)
        $alerts = [
            // Produits publiés sans image principale (via la relation media)
            'missing_main_image' => Product::where('status', 'published')
                ->whereDoesntHave('media', function ($query) {
                    $query->where('is_primary', true);
                })->count(),

            // Produits publiés sans meta description
            'missing_seo_description' => Product::where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('seo_description')
                          ->orWhere('seo_description', '');
                })->count(),

            // Produits en rupture de stock
            'out_of_stock' => Product::where('status', 'published')
                ->where('stock_status', 'out_of_stock')
                ->count(),
                
            // Produits sans description courte (mauvais pour les listes)
            'missing_short_description' => Product::where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('short_description')
                          ->orWhere('short_description', '');
                })->count(),
        ];

        // 3. Activité récente (5 derniers produits modifiés/créés)
        $recentProducts = Product::with('primaryCategory')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'alerts', 'recentProducts'));
    }
}
