<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Store Controllers
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\CustomerProfileController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\OrderController as StoreOrderController;


// ===========================
// 🌿 Default route Breeze
// ===========================
Route::get('/', fn() => redirect()->route('store.home'));

require __DIR__.'/auth.php';


// ===========================
// 🏪 STORE / CUSTOMER ROUTES
// ===========================
Route::prefix('Hygeia')->group(function () {

    /**
     * ======================
     * 🏠 HOME
     * ======================
     */
    Route::get('/', [StoreHomeController::class, 'index'])->name('store.home');


    /**
     * ======================
     * 🛒 PRODUK
     * ======================
     */
    Route::get('/produk', [StoreProductController::class, 'index'])->name('store.product');
    Route::get('/produk/{name}', [StoreProductController::class, 'show'])->name('store.productdetail');


    /**
     * ======================
     * 👤 PROFILE CUSTOMER
     * ======================
     */
    Route::middleware('auth')
        ->prefix('profile')
        ->name('store.profile.')
        ->group(function () {

            Route::get('/', [CustomerProfileController::class, 'index'])->name('index');
            Route::post('/update', [CustomerProfileController::class, 'update'])->name('update');

            // Riwayat order
            Route::get('/orders', [CustomerProfileController::class, 'orders'])->name('orders');
        });


    /**
     * ======================
     * 🛍 CART (CUSTOMER)
     * ======================
     */
    // Menampilkan halaman cart
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('customer.cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('customer.cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('customer.cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('customer.cart.clear');

    // Checkout item terpilih
    Route::post('/cart/checkout-selected', [CartController::class, 'checkoutSelected'])
    ->name('customer.cart.checkoutSelected');


    /**
     * ======================
     * 💳 CHECKOUT
     * ======================
     */
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('customer.checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('store.checkout.process');


    /**
     * ======================
     * 📦 PAYMENT
     * ======================
     */
    Route::get('/payment', [StoreOrderController::class, 'showPaymentPage'])->name('customer.payment');
    Route::post('/order/store', [StoreOrderController::class, 'store'])->name('store.order.store');
    Route::get('/order/success/{id}', [StoreOrderController::class, 'success'])->name('store.order.success');
});


// ===========================
// 🛠️ ADMIN ROUTES
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {

    /**
     * ======================
     * 🔐 AUTH
     * ======================
     */
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');


    /**
     * ======================
     * 🗂️ KATEGORI & PRODUK
     * ======================
     */
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);


    /**
     * ======================
     * 👥 CUSTOMER
     * ======================
     */
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');


    /**
     * ======================
     * 📦 ORDER ADMIN
     * ======================
     */
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    /** Feedback */
    Route::get('/feedbacks', fn() => view('admin.feedbacks.index'))->name('feedbacks');
});
