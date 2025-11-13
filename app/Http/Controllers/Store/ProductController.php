<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 🛍️ Halaman semua produk
    public function index(Request $request)
    {
        // Ambil hanya kategori yang aktif untuk filter sidebar
        $categories = Category::where('status', 'Active')
            ->orderBy('name')
            ->get();

        // Query dasar produk
        $query = Product::with('category');

        // Filter kategori (jika dipilih)
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // Sorting (jika ada)
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'featured':
                    $query->where('is_featured', true)->latest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            // Default sorting: produk terbaru
            $query->latest();
        }

        // Pagination (12 produk per halaman)
        $products = $query->paginate(12)->appends($request->query());

        // Return ke view produk
        return view('store.product', compact('products', 'categories'));
    }

    // 📦 Halaman detail produk
    public function show($name)
    {
        // Decode nama produk dari URL
        $decodedName = urldecode($name);
        $decodedName = str_replace('+', ' ', $decodedName);
        $searchName = trim($decodedName);

        logger("Searching for product: '{$searchName}'");

        // Cari produk berdasarkan nama (case-insensitive)
        $product = Product::with('category')
            ->whereRaw('LOWER(name) = ?', [strtolower($searchName)])
            ->firstOrFail();

        // Ambil produk terkait
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('store.productdetail', compact('product', 'relatedProducts'));
    }

    public function productDetail($name)
    {
        $product = Product::with('category')
            ->where('name', urldecode($name))
            ->firstOrFail();

        return view('store.productdetail', compact('product'));
    }
}
