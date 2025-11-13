@extends('layouts.admin')

@section('content')

<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Product Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Product</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $totalProducts }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Low Stock Alerts</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $lowStockAlerts }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Categories</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $totalCategories }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Stock Value</p>
            <h4 class="text-2xl font-bold text-teal-600">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</h4>
        </div>
    </div>
</section>

<form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center justify-between w-full mx-auto p-2 mt-6 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            name="search"
            placeholder="Search product..." 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500"
            value="{{ request('search') }}">
            
        <button type="submit" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </div>

    <select name="category" onchange="this.form.submit()" class="flex-shrink-0 ml-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-blue-300">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</form>

<section class="bg-white shadow rounded-lg p-6 mt-4">
    <button 
        data-modal-target="modal-tambahproduk" 
        data-modal-toggle="modal-tambahproduk" 
        type="button"
        class="mb-3 flex items-center space-x-1 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" />
        </svg>
        <span>Add Product</span>
    </button>

    @if(session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
         <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-teal-200 text-left text-sm table-fixed">
            <thead class="bg-teal-50 text-dark text-center border border-teal-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 w-28">Product ID</th>
                    <th class="border border-gray-300 px-4 py-2 w-24">Picture</th>
                    <th class="border border-gray-300 px-4 py-2">Product Name</th>
                    <th class="border border-gray-300 px-4 py-2 w-40">Category</th>
                    <th class="border border-gray-300 px-4 py-2 w-32">Price</th>
                    <th class="border border-gray-300 px-4 py-2 w-24">Stock</th>
                    <th class="border border-gray-300 px-4 py-2 w-36">Status</th>
                    <th class="border border-gray-300 px-4 py-2 w-28">Action</th>
                </tr>
            </thead>
            <tbody class="text-center text-gray-700">
                @forelse($products as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->product_id }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg mx-auto">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg mx-auto flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if($product->stock > 100)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
                                In Stock
                            </span>
                        @elseif($product->stock >= 51)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                Medium Stock
                            </span>
                        @elseif($product->stock >= 10)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                Low Stock
                            </span>
                        @elseif($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                Critical
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                Out of Stock
                            </span>
                        @endif
                    </td>                
                    <td class="border border-gray-300 px-4 py-2">
                        
                        <button 
                            type="button"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200 edit-btn"
                            data-update-url="{{ route('admin.products.update', $product->id) }}"
                            data-name="{{ $product->name }}"
                            data-category-id="{{ $product->category_id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}"
                            data-description="{{ $product->description }}"
                            data-image-url="{{ $product->image_url }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                <path fill="#3B82F6" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                        </button>

                        <button 
                            type="button"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50 transition-colors duration-200 delete-btn"
                            data-delete-url="{{ route('admin.products.destroy', $product->id) }}"
                            data-product-name="{{ $product->name }}"
                            data-product-id="{{ $product->product_id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#EF4444" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                        Tidak ada data produk ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->appends(request()->query())->links() }}
    </div>
</section>

<div id="modal-tambahproduk" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Add New Product</h3>
                <button type="button" data-modal-toggle="modal-tambahproduk" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>

            <form class="p-4" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                    <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama produk" value="{{ old('name') }}" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select name="category_id" class="w-full p-2 border border-gray-300 rounded-lg text-sm" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Price (Rp)</label>
                        <input type="number" name="price" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan harga" value="{{ old('price') }}" required>
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                        <input type="number" name="stock" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan stok" value="{{ old('stock') }}" required>
                        @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Product Picture</label>
                    <div 
                        id="dropzone-tambah"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <input 
                            id="file-upload-tambah" 
                            type="file" 
                            name="image" 
                            accept="image/*" 
                            class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="mb-2">
                            <path fill="#6B7280" d="M5 3h13a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m0 1a2 2 0 0 0-2 2v11.59l4.29-4.3l2.5 2.5l5-5L20 16V6a2 2 0 0 0-2-2zm4.79 13.21l-2.5-2.5L3 19a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-1.59l-5.21-5.2zM7.5 6A2.5 2.5 0 0 1 10 8.5A2.5 2.5 0 0 1 7.5 11A2.5 2.5 0 0 1 5 8.5A2.5 2.5 0 0 1 7.5 6m0 1A1.5 1.5 0 0 0 6 8.5A1.5 1.5 0 0 0 7.5 10A1.5 1.5 0 0 0 9 8.5A1.5 1.5 0 0 0 7.5 7"/>
                        </svg>
                        <p class="text-sm text-gray-600"><span class="font-medium text-teal-600">Klik untuk upload</span> atau drag and drop</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG maksimal 5MB</p>
                    </div>
                    <div id="preview-container-tambah" class="mt-3 hidden">
                        <img id="image-preview-tambah" class="w-32 h-32 object-cover rounded-lg border border-gray-200" alt="Preview">
                    </div>
                     @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Save Product
                </button>
            </form>
        </div>
    </div>
</div>

<div id="modal-editproduk" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
                <button type="button" class="text-gray-400 hover:text-gray-700 rounded-lg p-1 close-modal-btn">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>
            
            <form class="p-4" method="POST" action="" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                    <input type="text" name="name" id="edit-name" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama produk" value="" required>
                    <p class="text-red-500 text-xs mt-1 error-message hidden" id="edit-name-error"></p>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select name="category_id" id="edit-category" class="w-full p-2 border border-gray-300 rounded-lg text-sm" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Harga (Rp)</label>
                        <input type="number" name="price" id="edit-price" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan harga" value="" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Persediaan</label>
                        <input type="number" name="stock" id="edit-stock" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan stok" value="" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea name="description" id="edit-description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan deskripsi produk"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Gambar Produk (Opsional)</label>
                    
                    <div id="edit-image-preview-container" class="mb-2 hidden">
                        <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                        <img id="edit-image-preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                    </div>

                    <input type="file" name="image" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                </div>
                
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<div id="modal-hapus" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center p-4 border-b border-gray-200">
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
            </div>
            
            <form class="p-6 text-center" method="POST" action="" id="delete-form">
                @csrf
                @method('DELETE')
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Produk</h3>
                <p class="text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus produk 
                    <span class="font-semibold text-gray-900" id="delete-product-name"></span> 
                    (<span class="text-gray-500" id="delete-product-id"></span>)?
                </p>
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg mb-4">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <div class="flex justify-center space-x-3">
                    <button 
                        type="button" 
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-gray-200 close-modal-btn">
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- Referensi ke Modal ---
    const modalEdit = document.getElementById('modal-editproduk');
    const modalHapus = document.getElementById('modal-hapus');
    const modalTambah = document.getElementById('modal-tambahproduk');

    // --- Referensi ke Form ---
    const formEdit = document.getElementById('edit-form');
    const formHapus = document.getElementById('delete-form');

    // --- 1. LOGIKA UNTUK MODAL EDIT ---
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil semua data dari tombol
            const updateUrl = this.dataset.updateUrl;
            const name = this.dataset.name;
            const categoryId = this.dataset.categoryId;
            const price = this.dataset.price;
            const stock = this.dataset.stock;
            const description = this.dataset.description;
            const imageUrl = this.dataset.imageUrl;

            // Bersihkan error validasi lama (jika ada)
            formEdit.querySelectorAll('.error-message').forEach(el => el.classList.add('hidden'));

            // Isi form modal edit
            formEdit.setAttribute('action', updateUrl);
            formEdit.querySelector('#edit-name').value = name;
            formEdit.querySelector('#edit-category').value = categoryId;
            formEdit.querySelector('#edit-price').value = price;
            formEdit.querySelector('#edit-stock').value = stock;
            formEdit.querySelector('#edit-description').value = description;

            // Tampilkan/sembunyikan preview gambar
            const imgPreviewContainer = formEdit.querySelector('#edit-image-preview-container');
            const imgPreview = formEdit.querySelector('#edit-image-preview');
            if (imageUrl) {
                imgPreview.setAttribute('src', imageUrl);
                imgPreviewContainer.classList.remove('hidden');
            } else {
                imgPreviewContainer.classList.add('hidden');
            }
            
            // Tampilkan modal edit
            modalEdit.classList.remove('hidden');
        });
    });

    // --- 2. LOGIKA UNTUK MODAL HAPUS ---
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari tombol
            const deleteUrl = this.dataset.deleteUrl;
            const productName = this.dataset.productName;
            const productId = this.dataset.productId;

            // Isi form modal hapus
            formHapus.setAttribute('action', deleteUrl);
            modalHapus.querySelector('#delete-product-name').textContent = productName;
            modalHapus.querySelector('#delete-product-id').textContent = productId;

            // Tampilkan modal hapus
            modalHapus.classList.remove('hidden');
        });
    });
    
    // --- 3. LOGIKA UNTUK TOMBOL "Add Product" (Flowbite) ---
    document.querySelector('[data-modal-target="modal-tambahproduk"]').addEventListener('click', () => {
        modalTambah.classList.remove('hidden');
    });

    // --- 4. LOGIKA UNTUK MENUTUP SEMUA MODAL ---
    // Tombol close (X) dan Batal
    document.querySelectorAll('.close-modal-btn').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.fixed.z-50').classList.add('hidden');
        });
    });
    
    // Tombol close (X) di modal tambah (yang pakai data-modal-toggle)
    document.querySelector('[data-modal-toggle="modal-tambahproduk"]').addEventListener('click', () => {
         modalTambah.classList.add('hidden');
    });

    // Klik di luar (backdrop)
    window.addEventListener('click', function(e) {
        if (e.target === modalEdit || e.target === modalHapus || e.target === modalTambah) {
            e.target.classList.add('hidden');
        }
    });

    // --- 5. LOGIKA PREVIEW GAMBAR (HANYA UNTUK MODAL TAMBAH) ---
    const dropzoneTambah = document.getElementById('dropzone-tambah');
    const fileInputTambah = document.getElementById('file-upload-tambah');
    const previewContainerTambah = document.getElementById('preview-container-tambah');
    const imagePreviewTambah = document.getElementById('image-preview-tambah');

    if (dropzoneTambah) {
        dropzoneTambah.addEventListener('click', () => fileInputTambah.click());
        setupDropzone(dropzoneTambah, fileInputTambah, imagePreviewTambah, previewContainerTambah);
    }
    
    function setupDropzone(dropzone, fileInput, previewElement, containerElement) {
        if (!dropzone) return; 
        dropzone.addEventListener('dragover', (e) => { e.preventDefault(); dropzone.classList.add('bg-gray-100', 'border-teal-500'); });
        dropzone.addEventListener('dragleave', () => { dropzone.classList.remove('bg-gray-100', 'border-teal-500'); });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-gray-100', 'border-teal-500');
            const file = e.dataTransfer.files[0];
            fileInput.files = e.dataTransfer.files; 
            handleFile(file, previewElement, containerElement);
        });
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handleFile(file, previewElement, containerElement);
        });
    }

    function handleFile(file, previewElement, containerElement) {
        if (!file) return;
        if (!file.type.startsWith('image/')) { alert('Silakan upload file gambar.'); return; }
        if (file.size > 5 * 1024 * 1024) { alert('File terlalu besar! Maksimal 5MB.'); return; }
        const reader = new FileReader();
        reader.onload = (e) => {
            previewElement.src = e.target.result;
            containerElement.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    // --- 6. LOGIKA ERROR VALIDASI (NON-AJAX) ---
    
    // 1. Cek untuk Modal EDIT
    @if ($errors->any() && session('error_modal_id'))
        // Ambil ID produk yang error dari session
        const errorProductId = "{{ session('error_modal_id') }}";
        // Cari tombol edit yang sesuai dengan ID itu
        const errorButton = document.querySelector(`.edit-btn[data-update-url*="/${errorProductId}"]`);
        
        if (errorButton) {
            // "Klik" tombol itu secara virtual untuk mengisi modal
            errorButton.click(); 

            // Sekarang, tampilkan error validasi di dalam modal edit
            @foreach ($errors->all() as $error)
                @if (str_contains($error, 'Nama Produk') || str_contains($error, 'name'))
                    const nameError = document.getElementById('edit-name-error');
                    nameError.textContent = "{{ $error }}";
                    nameError.classList.remove('hidden');
                @endif
                // Tambahkan 'else if' untuk error input lainnya jika perlu
            @endforeach
        }
    
    // 2. Cek untuk Modal TAMBAH
    @elseif ($errors->any() && !session('error_modal_id'))
        // Jika error BUKAN dari modal edit, pasti dari modal tambah.
        modalTambah.classList.remove('hidden');
    @endif

});
</script>
@endpush