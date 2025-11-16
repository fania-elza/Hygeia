<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'status'         => 'diproses', // default
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
        $user = Auth::user();

        // Order yang baru selesai (untuk ditampilkan sebagai highlight jika mau)
        $currentOrder = Order::with('orderItems.product')->findOrFail($id);

        // Semua order milik user
        $orders = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('customer.profile.orders', compact('user', 'orders', 'currentOrder'));
    }

    public function showPaymentPage(Request $request)
    {
        // Ambil data checkout dari session atau request
        $checkoutItems = session('checkoutItems', []);
        $totalAmount   = session('totalAmount', 0);

        return view('customer.payment', compact('checkoutItems', 'totalAmount'));
    }

    public function viewInvoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        // TAMPILKAN HALAMAN HTML
        return view('customer.invoice', compact('order'));
    }

    public function downloadInvoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        $pdf = Pdf::loadView('customer.invoice', compact('order'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('invoice-'.$order->id.'.pdf');
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Hanya bisa dibatalkan jika status belum dikirim
        if ($order->status === 'Dikirim') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah dikirim.');
        }

        $order->status = 'cancel';
        $order->save();

        return redirect()->route('store.profile.orders')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
