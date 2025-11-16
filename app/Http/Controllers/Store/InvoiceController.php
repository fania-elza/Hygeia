<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('invoice', compact('order'));
    }
}
