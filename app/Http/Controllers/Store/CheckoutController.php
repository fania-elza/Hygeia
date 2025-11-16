<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class CheckoutController extends Controller
{
    /**
     * 🛒 Tampilkan halaman checkout
     */
    public function show()
    {
        $checkoutItems = session()->get('checkout_items', []);

        if (empty($checkoutItems)) {
            return redirect()->route('customer.cart')
                ->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        // Hitung subtotal, ongkos kirim, diskon
        $subtotal = collect($checkoutItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shippingCost = 10000;
        $discount = $subtotal >= 50000 ? 5000 : 0;
        $total = max(0, $subtotal + $shippingCost - $discount);

        $addresses = Auth::check()
            ? Address::where('customer_id', Auth::id())->get()
            : collect();

        return view('customer.checkout', compact(
            'checkoutItems',
            'subtotal',
            'shippingCost',
            'discount',
            'total',
            'addresses'
        ));
    }

    /**
     * 🧾 Simpan alamat pengiriman dan lanjut ke pembayaran
     */
    public function process(Request $request)
    {
        if ($request->address_option === 'saved' && $request->has('selected_address')) {
            $address = Address::where('id', $request->selected_address)
                ->where('customer_id', Auth::id())
                ->firstOrFail();

            $shippingInfo = $address->only([
                'id',
                'receiver_name',
                'phone_number',
                'full_address',
                'city',
                'postal_code',
                'notes',
            ]);
            $shippingInfo['type'] = 'saved'; // tandai alamat tersimpan
        } else {
            $validated = $request->validate([
                'receiver_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'full_address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
                'notes' => 'nullable|string|max:255',
            ]);

            $shippingInfo = $validated;
            $shippingInfo['type'] = 'new'; // tandai alamat baru

            // Simpan ke DB jika user login
            if (Auth::check()) {
                Address::create([
                    'customer_id' => Auth::id(),
                    ...$validated
                ]);
            }
        }

        // Simpan alamat ke session
        session()->put('shipping_info', $shippingInfo);

        return redirect()->route('customer.payment')
            ->with('success', 'Alamat pengiriman berhasil disimpan.');
    }

    public function directCheckout(Request $request)
    {
        $productId = $request->query('product_id');
        $qty = $request->query('qty', 1);

        $product = \App\Models\Product::findOrFail($productId);

        session()->put('checkout_items', [[
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'quantity'   => $qty,
            'image'      => $product->image ?? 'https://via.placeholder.com/64',
        ]]);

        return $this->show(); // tampilkan halaman checkout langsung
    }


    /**
     * 💳 Halaman pembayaran
     */
    public function payment()
    {
        $checkoutItems = session()->get('checkout_items', []);
        $shippingInfo = session()->get('shipping_info', []);

        if (empty($checkoutItems)) {
            return redirect()->route('customer.cart')
                ->with('error', 'Keranjang checkout kosong.');
        }

        if (empty($shippingInfo)) {
            return redirect()->route('customer.checkout')
                ->with('error', 'Silakan isi alamat pengiriman terlebih dahulu.');
        }

        // Pastikan setiap item punya URL gambar lengkap
        $checkoutItems = collect($checkoutItems)->map(function($item) {
            $item['image'] = $item['image'] ?? 'https://via.placeholder.com/64';
            return $item;
        })->toArray();

        // Hitung subtotal, ongkos kirim, diskon
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
