<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product; // 1. DITAMBAHKAN: Dibutuhkan untuk statistik & pengecekan
use Illuminate\Support\Facades\Validator; // 2. DITAMBAHKAN: Dibutuhkan for validasi modal

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori dengan fitur search dan statistik
     */
    public function index(Request $request)
    {
        // 3. DIPERBAIKI: Langsung muat relasi yang dibutuhkan oleh view
        // withCount('products') -> untuk kolom 'Total Product' di tabel
        // with('products')      -> untuk list produk di modal edit
        $query = Category::withCount('products')->with('products');

        // Fitur search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate(10); // Pagination

        // Hitung statistik untuk dashboard
        $totalCategories = Category::count();
        $activeCategories = Category::where('status', 'active')->count();
        $inactiveCategories = Category::where('status', 'inactive')->count();
        
        // 4. DIPERBAIKI: Mengambil total produk dari tabel products, bukan 'total_product'
        $totalProducts = Product::count(); 

        return view('admin.categories.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'inactiveCategories',
            'totalProducts'
        ));
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        // 5. DIPERBAIKI: Menggunakan Validator manual untuk error handling modal
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // 6. DITAMBAHKAN: Logika untuk redirect jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.categories.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error_modal_type', 'create'); // Tandai modal 'create' yg error
        }
        
        // Generate category_id otomatis: 3 huruf konsonan pertama + angka unik
        $category_id = $this->generateCategoryId($request->name);

        Category::create([
            'category_id' => $category_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active', // Default active
            // 'total_product' => 0, // DIHAPUS: Sebaiknya jangan gunakan kolom ini, gunakan relasi
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update kategori
     */
    // 7. DIPERBAIKI: Menggunakan Route Model Binding (Category $category)
    public function update(Request $request, Category $category)
    {
        // 8. DIPERBAIKI: Menggunakan Validator manual
        $validator = Validator::make($request->all(), [
            // Pastikan 'name' unik, kecuali untuk dirinya sendiri
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // 9. DITAMBAHKAN: Logika redirect jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.categories.index', ['page' => $request->page])
                ->withErrors($validator)
                ->withInput()
                // Kirim ID modal spesifik yang error
                ->with('error_modal_id', $category->id); 
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index', ['page' => $request->page])
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    // 10. DIPERBAIKI: Menggunakan Route Model Binding
    public function destroy(Category $category)
    {
        // 11. DITAMBAHKAN: Pengecekan keamanan
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                             ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Method helper untuk generate Category ID unik
     * (Logika ini sudah bagus, tidak diubah)
     */
    private function generateCategoryId(string $name): string
    {
        // Ambil konsonan dari name (huruf besar, abaikan vokal dan spasi)
        $consonants = preg_replace('/[^BCDFGHJKLMNPQRSTVWXYZ]/i', '', strtoupper($name));
        
        // Ambil 3 konsonan pertama, atau isi dengan 'CAT' jika kurang dari 3
        $code = substr($consonants, 0, 3);
        if (strlen($code) < 3) {
            $code = str_pad($code, 3, 'CAT', STR_PAD_RIGHT); // Fallback jika konsonan kurang
        }

        // Cari ID unik dengan menambah angka (misal: ELK001, ELK002, dll.)
        $counter = 1;
        $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        while (Category::where('category_id', $uniqueId)->exists()) {
            $counter++;
            $uniqueId = $code . str_pad($counter, 3, '0', STR_PAD_LEFT);
        }

        return $uniqueId;
    }
}