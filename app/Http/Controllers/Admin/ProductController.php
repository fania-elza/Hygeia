<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman utama dengan data dan filter.
     */
    public function index(Request $request)
    {
        $query = Product::with('category'); 

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('product_id', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10); 

        // Hitung statistik
        $totalProducts = Product::count();
        $lowStockAlerts = Product::lowStock()->count();
        $totalCategories = Category::count();
        $totalStockValue = Product::sum(DB::raw('price * stock'));
        
        $categories = Category::orderBy('name')->get(); 

        return view('admin.product.index', compact(
            'products',
            'totalProducts',
            'lowStockAlerts',
            'totalCategories',
            'totalStockValue',
            'categories'
        ));
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Validasi 'status' dihapus
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.products.index', ['page' => $request->page])
                ->withErrors($validator)
                ->withInput();
        }
        
        $validated = $validator->validated();

        // PERBAIKAN: Status di-set 'active' secara otomatis
        $validated['status'] = 'active'; 

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }
        
        Product::create($validated);

        return redirect()->route('admin.products.index', ['page' => $request->page])
                         ->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Update produk yang ada.
     */
    public function update(Request $request, Product $product)
    {
         // PERBAIKAN: Validasi 'status' dihapus
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:5120', 
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.products.index', ['page' => $request->page])
                ->withErrors($validator)
                ->withInput()
                ->with('error_modal_id', $product->id); 
        }

        $validated = $validator->validated();

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index', ['page' => $request->page])
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        // PERBAIKAN: Rute disamakan
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('store.productdetail', compact('product'));
    }
}