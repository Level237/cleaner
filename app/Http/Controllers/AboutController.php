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
        View::share('seoTitle', 'Notre Maison | Cleaner, maison de thés bien-être');

        return view('about.index');
    }
}
