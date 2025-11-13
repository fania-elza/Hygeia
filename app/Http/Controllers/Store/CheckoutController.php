<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout (rangkuman pesanan)
     */
    public function show()
    {
        // Ambil produk yang akan di-checkout dari session
        $checkoutItems = session()->get('checkout_items', []);

        // Jika kosong, kembali ke cart
        if (empty($checkoutItems)) {
            return redirect()->route('store.cart')
                ->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        // Hitung subtotal
        $subtotal = collect($checkoutItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Ongkos kirim & diskon (bisa diubah sesuai kebutuhan)
        $shippingCost = 10000;
        $discount = $subtotal >= 50000 ? 5000 : 0;

        // Total keseluruhan
        $total = $subtotal + $shippingCost - $discount;

        return view('customer.checkout', compact(
            'checkoutItems',
            'subtotal',
            'shippingCost',
            'discount',
            'total'
        ));
    }

    /**
     * Simpan alamat pengiriman dan lanjut ke halaman pembayaran
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:255',
        ]);

        // Simpan data alamat ke session
        session()->put('shipping_info', $validated);

        // Redirect ke halaman pembayaran
        return redirect()->route('store.checkout.payment')
            ->with('success', 'Alamat pengiriman berhasil disimpan.');
    }

    /**
     * Halaman pembayaran
     */
    public function payment()
    {
        $checkoutItems = session()->get('checkout_items', []);
        $shippingInfo = session()->get('shipping_info', []);

        // Pastikan ada data checkout
        if (empty($checkoutItems)) {
            return redirect()->route('store.cart')
                ->with('error', 'Keranjang checkout kosong.');
        }

        // Jika belum isi alamat, arahkan ke checkout
        if (empty($shippingInfo)) {
            return redirect()->route('store.checkout')
                ->with('error', 'Silakan isi alamat pengiriman terlebih dahulu.');
        }

        // Hitung ulang total agar konsisten
        $subtotal = collect($checkoutItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shippingCost = 10000;
        $discount = $subtotal >= 50000 ? 5000 : 0;
        $total = $subtotal + $shippingCost - $discount;

        return view('customer.payment', compact(
            'checkoutItems',
            'shippingInfo',
            'subtotal',
            'shippingCost',
            'discount',
            'total'
        ));
    }
}
