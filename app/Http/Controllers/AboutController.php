<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AboutController extends Controller
{
    /**
     * Display the 'Notre Maison' page.
     */
    public function index()
    {
        View::share('seoTitle', 'Notre Maison & Engagements Qualité | Cleaner, maison de thés bien-être');
        View::share('seoDescription', 'Plongez dans l\'univers Cleaner : notre histoire, notre savoir-faire artisanal et notre sélection exigeante d\'ingrédients 100% naturels pour vos rituels bien-être.');
        View::share('seoImage', asset('assets/maison.png'));

        return view('about.index');
    }
}
