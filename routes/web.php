<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ProfileController;
use App\Models\FarmProduct;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-products', [HomeController::class, 'searchProducts']);
Route::get('/farmers-by-location', [HomeController::class, 'getFarmersByLocation']);
Route::get('/products', [HomeController::class, 'allProducts'])->name('products');
Route::get('/product/{id}', [HomeController::class, 'viewProduct'])->name('product.show');
Route::get('/product/{id}', [HomeController::class, 'viewProduct'])->name('product.show');
Route::post('/create-order', [ProductOrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/farmer/{id}', [HomeController::class, 'viewFarmer'])->name('farmer.show');

// Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');
    Route::get('/dashboard/export', [DashboardController::class, 'exportData'])->name('dashboard.export');
});


// Buyer Order Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [ProductOrderController::class, 'buyerIndex'])->name('buyer.orders.index');
    Route::get('/my-order/{order}', [ProductOrderController::class, 'buyerShow'])->name('buyer.orders.show');
    Route::patch('/my-order/{order}/cancel', [ProductOrderController::class, 'buyerCancel'])->name('buyer.orders.cancel');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Start Farm Products Routes
    Route::get('/farm-products', [FarmProductController::class, 'index'])->name('farm-products.index');
    Route::get('/farm-products/new', [FarmProductController::class, 'create'])->name('farm-products.create');
    Route::post('/farm-products', [FarmProductController::class, 'store'])->name('farm-products.store');
    Route::post('/farm-products/{farmProduct}/validate-stock', [FarmProductController::class, 'validateStock'])
        ->name('farm-products.validate-stock');
    Route::get('/farm-products/{farmProduct}', [FarmProductController::class, 'show'])->name('farm-products.show');
    Route::get('/farm-products/{farmProduct}/edit', [FarmProductController::class, 'edit'])->name('farm-products.edit');
    Route::get('/farm-products/{farmProduct}/stock', [FarmProductController::class, 'getStock'])
        ->name('farm-products.get-stock');
    Route::patch('/farm-products/{farmProduct}', [FarmProductController::class, 'update'])->name('farm-products.update');
    Route::delete('/farm-products', [FarmProductController::class, 'destroy'])->name('farm-products.destroy');
    //End Farm Products Routes



    // Product detail API routes
    Route::get('/farm-products/{farmProduct}/chart-data', [FarmProductController::class, 'getChartData'])
        ->name('farm-products.chart-data');

    Route::post('/farm-products/{farmProduct}/update-stock', [FarmProductController::class, 'updateStock'])
        ->name('farm-products.update-stock');

    Route::post('/farm-products/{farmProduct}/update-price', [FarmProductController::class, 'updatePrice'])
        ->name('farm-products.update-price');

    Route::post('/farm-products/{farmProduct}/toggle-status', [FarmProductController::class, 'toggleStatus'])
        ->name('farm-products.toggle-status');

    Route::get('/farm-products/{farmProduct}/report', [FarmProductController::class, 'exportReport'])
        ->name('farm-products.export-report');

    Route::post('/farm-products/{farmProduct}/duplicate', [FarmProductController::class, 'duplicateProduct'])
        ->name('farm-products.duplicate');



    //Start Farm Products Categories Routes
    Route::get('/farm-products-categories', [FarmProductController::class, 'all_categories'])->name('farm-products-categories.index');
    Route::post('/farm-products-categories', [FarmProductController::class, 'create_category'])->name('farm-products-categories.store');
    Route::patch('/farm-products-categories/{category}', [FarmProductController::class, 'update_category'])->name('farm-products-categories.update');
    Route::delete('/farm-products-categories', [FarmProductController::class, 'destroy_category'])->name('farm-products-categories.destroy');
    //End Farm Products Categories Routes

    // Order Routes

    Route::get('/orders/', [ProductOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [ProductOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [ProductOrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [ProductOrderController::class, 'update'])->name('orders.update');
    Route::delete('/{order}', [ProductOrderController::class, 'destroy'])->name('orders.destroy');
});

require __DIR__ . '/auth.php';
