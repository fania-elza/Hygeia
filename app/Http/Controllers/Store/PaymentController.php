<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran
     */
    public function show()
    {
        // Gunakan session yang sama dengan CheckoutController
        $shippingInfo = Session::get('shipping_info');
        $checkoutItems = Session::get('checkout_items', []);

        if (empty($shippingInfo) || empty($checkoutItems)) {
            return redirect()->route('store.checkout.show')
                ->with('error', 'Silakan isi alamat pengiriman terlebih dahulu.');
        }

        // Hitung total pembayaran
        $subtotal = collect($checkoutItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shippingCost = 10000;
        $discount = $subtotal >= 50000 ? 5000 : 0;
        $total = $subtotal + $shippingCost - $discount;

        return view('customer.payment', [
            'shippingInfo' => $shippingInfo,
            'checkoutItems' => $checkoutItems,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'discount' => $discount,
            'total' => $total
        ]);
    }

    /**
     * Menyimpan pesanan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method' => 'required|string|in:Kartu Kredit,COD,QRIS',
        ]);

        $checkoutItems = Session::get('checkout_items', []);
        $shippingInfo = Session::get('shipping_info', []);

        if (empty($checkoutItems) || empty($shippingInfo)) {
            return redirect()->route('store.checkout.show')
                ->with('error', 'Silakan isi alamat pengiriman terlebih dahulu.');
        }

        // Hitung total
        $subtotal = collect($checkoutItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shippingCost = 10000;
        $discount = $subtotal >= 50000 ? 5000 : 0;
        $total = $subtotal + $shippingCost - $discount;

        // Status awal pesanan
        $status = $request->method === 'COD' ? 'processing' : 'pending_payment';

        try {
            DB::beginTransaction();

            // Buat order utama
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'payment_method' => $request->method,
                'status' => $status,
                'shipping_address' => json_encode($shippingInfo),
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
            ]);

            // Buat order items
            foreach ($checkoutItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            // Bersihkan session
            Session::forget(['checkout_items', 'shipping_info']);

            return redirect()->route('store.order.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }

    /**
     * Menampilkan halaman sukses pesanan
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }

        return view('store.success', compact('order'));
    }
}
