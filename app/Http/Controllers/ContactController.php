<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function index()
    {
        View::share('seoTitle', 'Contactez-nous & Assistance Client | ' . config('app.name'));
        View::share('seoDescription', 'Une question sur nos thés bien-être, vos commandes ou nos conseils de préparation ? L\'équipe Cleaner est à votre écoute par message ou WhatsApp.');
        View::share('seoImage', asset('assets/logo.png'));
        return view('contact.index');
    }

    /**
     * Store a contact message in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais !');
    }
}
