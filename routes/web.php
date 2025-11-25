<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Middleware\AdminMiddleware;

// Landing page
Route::get('/', function () {
    return view('home');
})->name('home');

// Public products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/{product}/rate', [ProductController::class, 'rate'])
    ->middleware('auth')
    ->name('products.rate');

// User dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Auth-only routes
Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);
    });

require __DIR__.'/auth.php';
