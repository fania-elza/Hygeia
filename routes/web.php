<?php

use Illuminate\Support\Facades\Route;

// ===========================
// Admin Controllers
// ===========================
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;

// ===========================
// Store Controllers
// ===========================
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\CustomerProfileController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\OrderController as StoreOrderController;

// ===========================
// Default redirect
// ===========================
Route::get('/', fn() => redirect()->route('store.home'));
require __DIR__.'/auth.php'; // Breeze / auth routes

// ===========================
// 🏪 STORE / CUSTOMER ROUTES
// ===========================
Route::prefix('Hygeia')->group(function () {

    // Home
    Route::get('/', [StoreHomeController::class, 'index'])->name('store.home');

    // Produk
    Route::get('/produk', [StoreProductController::class, 'index'])->name('store.product');
    Route::get('/produk/{name}', [StoreProductController::class, 'show'])->name('store.productdetail');

    // Profile, Orders, Invoice (harus login)
    Route::middleware('auth')->prefix('profile')->name('store.profile.')->group(function () {
        // Profil
        Route::get('/', [CustomerProfileController::class, 'index'])->name('index');
        Route::put('/update', [CustomerProfileController::class, 'update'])->name('update');
        Route::post('/update-photo', [CustomerProfileController::class, 'updatePhoto'])->name('updatePhoto');

        // Orders
        Route::get('/orders', [CustomerProfileController::class, 'orders'])->name('orders');
        Route::post('/orders/{id}/cancel', [StoreOrderController::class, 'cancel'])->name('order.cancel');

        // Invoice
        Route::get('/invoice/{id}', [StoreOrderController::class, 'viewInvoice'])->name('invoice.view');
        Route::get('/invoice/download/{id}', [StoreOrderController::class, 'downloadInvoice'])->name('invoice.download');

        // Alamat Customer
        Route::get('/address', [CustomerProfileController::class, 'showAddresses'])->name('address'); // list alamat
        Route::get('/address/create', [CustomerProfileController::class, 'createAddress'])->name('address.create'); // form tambah
        Route::post('/address', [CustomerProfileController::class, 'storeAddress'])->name('address.store'); // simpan
        Route::get('/address/{address}/edit', [CustomerProfileController::class, 'editAddress'])->name('address.edit'); // form edit
        Route::put('/address/{address}', [CustomerProfileController::class, 'updateAddress'])->name('address.update'); // update
        Route::delete('/address/{address}', [CustomerProfileController::class, 'deleteAddress'])->name('address.destroy'); // delete
    });

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('customer.cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('customer.cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('customer.cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('customer.cart.clear');
    Route::post('/cart/checkout-selected', [CartController::class, 'checkoutSelected'])->name('customer.cart.checkoutSelected');

    // Checkout
    Route::get('/checkout/direct', [CheckoutController::class, 'directCheckout'])->name('customer.checkout.direct');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('customer.checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('store.checkout.process');

    // Payment / Order
    Route::get('/payment', [CheckoutController::class, 'payment'])->name('customer.payment');
    Route::post('/order/store', [StoreOrderController::class, 'store'])->name('store.order.store');
    Route::get('/order/success/{id}', [StoreOrderController::class, 'success'])->name('store.order.success');
});

// ===========================
// 🛠️ ADMIN ROUTES
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {

    // Redirect /admin langsung ke login
    Route::get('/', fn() => redirect()->route('admin.login'));

    // Login Admin (hanya untuk guest)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Semua route admin harus login
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/feedbacks', fn() => view('admin.feedbacks.index'))->name('feedbacks');
    });
});


