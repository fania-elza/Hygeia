<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\CustomerProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;

// ===========================
// 🌿 Default route Breeze
// ===========================
Route::get('/', function () {
    return redirect()->route('store.home');
});

require __DIR__.'/auth.php';

// ===========================
// 🏪 Store / Customer Routes
// ===========================
Route::prefix('Hygeia')->name('store.')->group(function () {

    // === HOME ===
    Route::get('/', [StoreHomeController::class, 'index'])->name('home');

    // === PRODUK ===
    Route::get('/produk', [StoreProductController::class, 'index'])->name('product');
    Route::get('/produk/{name}', [StoreProductController::class, 'show'])->name('productdetail');

    // === PROFILE ===
    Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [CustomerProfileController::class, 'index'])->name('index');
        Route::post('/update', [CustomerProfileController::class, 'update'])->name('update');
    });

    // === CART ===
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout-selected', [CartController::class, 'checkoutSelected'])->name('cart.checkoutSelected');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


    // === CHECKOUT ===
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
});


// ===========================
// 🛠️ Admin Routes
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/customers', fn() => view('admin.customer.index'))->name('customers');
    Route::get('/orders', fn() => view('admin.orders.index'))->name('orders');
    Route::get('/feedbacks', fn() => view('admin.feedbacks.index'))->name('feedbacks');
});
