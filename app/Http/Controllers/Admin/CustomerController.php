<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // model User sebagai customer
use App\Models\Order; // pastikan ada model Order

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role customer, hitung jumlah orders, dan ambil 5 order terbaru
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->with(['orders' => function($query) {
                $query->latest()->limit(5);
            }])
            ->get();

        return view('admin.customer.index', compact('customers'));
    }
}
