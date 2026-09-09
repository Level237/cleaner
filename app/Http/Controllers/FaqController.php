<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Support\Facades\View;

class FaqController extends Controller
{
    /**
     * Display the FAQ page.
     */
    public function index()
    {
        View::share('seoTitle', 'Foire Aux Questions (FAQ) | ' . config('app.name'));
        View::share('seoDescription', 'Retrouvez toutes les réponses à vos questions concernant la préparation de nos thés bien-être, les livraisons, les paiements et nos conseils santé.');
        View::share('seoImage', asset('assets/logo.png'));

        $faqs = Faq::active()->orderBy('order', 'asc')->get();

        return view('faq.index', compact('faqs'));
    }
}
