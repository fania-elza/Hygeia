<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /** 🛒 Menampilkan halaman troli */
    public function index(Request $request)
    {
        $cartItems = session()->get('cart', []);
        $selected = $request->input('selected_items', []);

        $subtotal = 0;
        $totalItems = 0;

        // Jika belum ada selected_items → tampilkan semua item
        $useAllItems = empty($selected);

        foreach ($cartItems as $id => $item) {
            $totalItems += $item['quantity'];
            if ($useAllItems || in_array($id, $selected)) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }

        $shippingCost = $subtotal > 0 ? 15000 : 0;
        $total = $subtotal + $shippingCost;

        return view('customer.cart', compact(
            'cartItems',
            'subtotal',
            'shippingCost',
            'total',
            'totalItems',
            'selected'
        ));
    }

    /** ➕ Menambahkan produk ke troli */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        $id = $product->id;
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
                'category' => $product->category->name ?? 'Tanpa Kategori',
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('store.cart')->with('success', "{$product->name} berhasil ditambahkan ke troli!");
    }

    /** 🔄 Memperbarui kuantitas item */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Produk tidak ditemukan di troli.');
        }

        $newQuantity = max(1, (int) $request->input('quantity', 1));
        $cart[$id]['quantity'] = $newQuantity;

        session()->put('cart', $cart);

        // kirim kembali selected items agar ringkasan tetap sesuai
        return redirect()->route('store.cart', [
            'selected_items' => $request->input('selected_items', [])
        ])->with('success', 'Kuantitas produk diperbarui.');
    }

    /** ❌ Menghapus item dari troli */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $productName = $cart[$id]['name'];
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->route('store.cart', [
                'selected_items' => $request->input('selected_items', [])
            ])->with('success', "{$productName} berhasil dihapus dari troli.");
        }

        return redirect()->route('store.cart')->with('error', 'Produk tidak ditemukan.');
    }

    /** 🧹 Kosongkan troli */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('store.cart')->with('success', 'Troli berhasil dikosongkan.');
    }

    /** ✅ Checkout item terpilih */
    public function checkoutSelected(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);
        $cart = session()->get('cart', []);
        $selectedProducts = [];

        foreach ($selectedItems as $id) {
            if (isset($cart[$id])) {
                $selectedProducts[$id] = $cart[$id];
            }
        }

        if (empty($selectedProducts)) {
            return redirect()->route('store.cart')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        session()->put('checkout_items', $selectedProducts);

        return redirect()->route('store.checkout.show')->with('success', 'Produk siap checkout.');
    }
}
