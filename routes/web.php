<?php

use App\Http\Controllers\FarmProductController;
use App\Http\Controllers\ProfileController;
use App\Models\FarmProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Start Farm Products Routes
    Route::get('/farm-products', [FarmProductController::class, 'index'])->name('farm-products.index');
    Route::get('/farm-products/new', [FarmProductController::class, 'create'])->name('farm-products.create');
    Route::post('/farm-products', [FarmProductController::class, 'store'])->name('farm-products.store');
    Route::get('/farm-products/{farmProduct}', [FarmProductController::class, 'show'])->name('farm-products.show');
    Route::get('/farm-products/{farmProduct}/edit', [FarmProductController::class, 'edit'])->name('farm-products.edit');
    Route::patch('/farm-products/{farmProduct}', [FarmProductController::class, 'update'])->name('farm-products.update');
    Route::delete('/farm-products', [FarmProductController::class, 'destroy'])->name('farm-products.destroy');
    //End Farm Products Routes


    //Start Farm Products Categories Routes
    Route::get('/farm-products-categories', [FarmProductController::class, 'all_categories'])->name('farm-products-categories.index');
    Route::post('/farm-products-categories', [FarmProductController::class, 'create_category'])->name('farm-products-categories.store');
    Route::patch('/farm-products-categories/{category}', [FarmProductController::class, 'update_category'])->name('farm-products-categories.update');
    Route::delete('/farm-products-categories', [FarmProductController::class, 'destroy_category'])->name('farm-products-categories.destroy');
    //End Farm Products Categories Routes
});

require __DIR__ . '/auth.php';
