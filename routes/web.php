<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/boutique', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/collections', [App\Http\Controllers\CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{slug}', [App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');
Route::get('/produits/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/produits/{slug}/avis', [App\Http\Controllers\ProductController::class, 'storeReview'])->name('products.reviews.store');

Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::patch('/panier/modifier', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/supprimer', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/commande', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/commande', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/commande/succes/{reference}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/recherche', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/notre-maison', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/faq', [\App\Http\Controllers\FaqController::class, 'index'])->name('faq');



use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;

Route::post('/currency', function (Request $request) {
    $validated = $request->validate([
        'currency' => ['required', 'string', 'in:' . implode(',', config('currency.available'))],
    ]);

    $request->session()->put('currency', strtoupper($validated['currency']));

    return back();
})->name('currency.set');
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('products.variants', ProductVariantController::class)->except(['show']);
    Route::resource('collections', CollectionController::class)->except(['show']);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class)->except(['show']);
    
    Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/reviews/{review}/toggle', [\App\Http\Controllers\Admin\ReviewController::class, 'toggleApproval'])->name('reviews.toggle');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    Route::get('/media', [\App\Http\Controllers\Admin\MediaController::class, 'index'])->name('media.index');
    Route::put('/media/{medium}', [\App\Http\Controllers\Admin\MediaController::class, 'update'])->name('media.update');
    Route::delete('/media/{medium}', [\App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
    Route::post('/media/bulk-update', [\App\Http\Controllers\Admin\MediaController::class, 'bulkUpdateAlt'])->name('media.bulk-update');
    
    Route::get('/archives', [\App\Http\Controllers\Admin\ArchiveController::class, 'index'])->name('archives.index');
    Route::post('/archives/{type}/{id}/restore', [\App\Http\Controllers\Admin\ArchiveController::class, 'restore'])->name('archives.restore');
    Route::delete('/archives/{type}/{id}/force-delete', [\App\Http\Controllers\Admin\ArchiveController::class, 'forceDelete'])->name('archives.force-delete');

    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
