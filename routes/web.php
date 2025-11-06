<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/product', function () {
    return view('admin.product.index');
})->name('product');

Route::get('/categories', function () {
    return view('admin.categories.index');
})->name('categories');

Route::get('/customers', function () {
    return view('admin.customer.index');
})->name('customers');

Route::get('/orders', function () {
    return view('admin.orders.index');
})->name('orders');

Route::get('/feedbacks', function () {
    return view('admin.feedbacks.index');
})->name('feedbacks');