<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StorefrontController;

Route::get('/', [StorefrontController::class, 'index'])->name('home');
Route::get('/products', [StorefrontController::class, 'products'])->name('products');
Route::get('/product/{slug}', [StorefrontController::class, 'product'])->name('product.show');
Route::get('/cart', [StorefrontController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [StorefrontController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [StorefrontController::class, 'removeFromCart'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [StorefrontController::class, 'placeOrder'])->name('checkout.store');
    Route::get('/order-confirmation/{id}', [StorefrontController::class, 'orderConfirmation'])->name('order.confirmation');
});

Route::get('/dashboard', [StorefrontController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
