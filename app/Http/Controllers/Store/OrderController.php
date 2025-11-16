<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'payment_method' => 'required|in:Kartu Kredit,COD,QRIS',
            'items'          => 'required|array',
            'total_amount'   => 'required|numeric',
        ]);

        // Buat Order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'payment_method' => $request->payment_method,
            'total_amount'   => $request->total_amount,
            'status'         => 'pending', // default
        ]);

        // Simpan item detail
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // Hapus cart/checkout jika kamu pakai session
        session()->forget('checkoutItems');
        session()->forget('shippingInfo');

        return redirect()
            ->route('store.order.success', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Halaman sukses.
     */
    public function success($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('store.order-success', compact('order'));
    }
}
