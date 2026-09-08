<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::visible()->get();
        return view('collections.index', compact('collections'));
    }
}
