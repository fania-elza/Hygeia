<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 produk terbaru beserta kategori-nya
        $products = Product::with('category')->latest()->take(8)->get();

        // Kirim data ke view
        return view('store.home', compact('products'));

        $products = Product::with('category')->paginate(12);
    }

    // halaman detail produk
    public function show($name)
    {
        // Handle URL decoding untuk spasi dan karakter khusus
        $decodedName = urldecode($name);
        
        // Juga handle kasus where + tidak ter-decode
        $decodedName = str_replace('+', ' ', $decodedName);
        $searchName = trim($decodedName);
        
        logger("Searching for product: '{$searchName}'");

        // Cari produk berdasarkan nama (case-insensitive)
        $product = Product::with('category')
            ->whereRaw('LOWER(name) = ?', [strtolower($searchName)])
            ->firstOrFail();

        // Ambil produk lain sebagai rekomendasi
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('store.productdetail', compact('product', 'relatedProducts'));
    }
}
