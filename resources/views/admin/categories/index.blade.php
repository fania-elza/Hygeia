@extends('layouts.admin')

@section('content')
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Category Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Categories</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ number_format($totalCategories) }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Active Categories</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ number_format($activeCategories) }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Inactive Categories</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ number_format($inactiveCategories) }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Product</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ number_format($totalProducts) }}</h4>
        </div>
    </div>
</section>

<div class="flex items-center justify-between w-full mx-auto p-4 mt-6 bg-white rounded-xl border border-gray-200 shadow-sm">
    <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Search categories..." 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500"
        >
        <button type="submit" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </form>
</div>

<section class="bg-white shadow rounded-lg p-6 mt-4">
    <button 
        data-modal-target="modal-tambahkategori" 
        data-modal-toggle="modal-tambahkategori" 
        type="button"
        class="mb-3 flex items-center space-x-1 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" />
        </svg>
        <span>Add Category</span>
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

    <table class="min-w-full border border-teal-200 text-left text-sm table-fixed">
        <thead class="bg-teal-50 text-gray-800 text-center">
            <tr>
                <th class="border border-gray-300 px-4 py-2 w-32">Category ID</th>
                <th class="border border-gray-300 px-4 py-2">Category Name</th>
                <th class="border border-gray-300 px-4 py-2">Description</th>
                <th class="border border-gray-300 px-4 py-2 w-32">Total Product</th>
                <th class="border border-gray-300 px-4 py-2 w-32">Status</th>
                <th class="border border-gray-300 px-4 py-2 w-28">Action</th>
            </tr>
        </thead>
        <tbody class="text-center text-gray-700">
            @forelse($categories as $category)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $category->category_id }}</td>
                <td class="border border-gray-300 px-4 py-2 text-left">{{ $category->name }}</td>
                <td class="border border-gray-300 px-4 py-2 text-left">{{ $category->description }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $category->products_count }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $category->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    
                    <button 
                        data-category-id="{{ $category->id }}"
                        data-category-name="{{ $category->name }}"
                        data-category-description="{{ $category->description }}"
                        data-category-status="{{ $category->status }}"
                        data-products-count="{{ $category->products_count }}"
                        data-products="{{ json_encode($category->products->pluck('name')) }}"
                        class="edit-btn inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200"
                        aria-label="Edit category {{ $category->name }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="#3B82F6" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                    </button>

                    <button 
                        data-category-id="{{ $category->id }}"
                        data-category-name="{{ $category->name }}"
                        class="delete-btn inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-red-500 hover:text-red-600 hover:bg-red-50 
                                transition-colors duration-200"
                        aria-label="Delete category {{ $category->name }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#EF4444" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</section>

<div id="modal-tambahkategori" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Add New Category</h3>
                <button type="button" data-modal-toggle="modal-tambahkategori" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="p-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Category Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama kategori" value="{{ old('name') }}" required>
                    @error('name') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" id="description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan deskripsi">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Save Category
                </button>
            </form>
        </div>
    </div>
</div>

<div id="modal-editkategori" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
                <button type="button" data-modal-toggle="modal-editkategori" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>
            
            <form action="" method="POST" id="edit-category-form" class="p-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                    <input type="text" name="name" id="edit-name" class="w-full p-2 border border-gray-300 rounded-lg text-sm" required>
                    @error('name') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="edit-description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea name="description" id="edit-description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Produk dalam Kategori Ini (<span id="edit-products-count">0</span>)
                    </label>
                    <div class="w-full max-h-40 overflow-y-auto border border-gray-200 rounded-lg bg-gray-50 p-3">
                        <ul class="list-disc list-inside text-sm text-gray-700 space-y-1" id="edit-products-list">
                            </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Status Kategori</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center space-x-1 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="status" value="active" id="edit-status-active" class="text-teal-600 focus:ring-teal-500">
                            <span>Active</span>
                        </label>
                        <label class="flex items-center space-x-1 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="status" value="inactive" id="edit-status-inactive" class="text-slate-600 focus:ring-slate-500">
                            <span>Inactive</span>
                        </label>
                    </div>
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
            
            <div class="p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Kategori</h3>
                <p class="text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus kategori 
                    <span class="font-semibold text-gray-900" id="category-name-hapus">Nama Kategori</span>?
                </p>
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg mb-4">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Tindakan ini tidak dapat dibatalkan. Produk terkait TIDAK akan terhapus.
                </p>
                
                <div class="flex justify-center space-x-3">
                    <button 
                        type="button" 
                        data-modal-toggle="modal-hapus"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-gray-200 transition-colors">
                        Batal
                    </button>
                    <form id="delete-form" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Referensi semua modal
    const modalTambah = document.getElementById('modal-tambahkategori');
    const modalEdit = document.getElementById('modal-editkategori');
    const modalHapus = document.getElementById('modal-hapus');

    // === Fungsi umum untuk buka/tutup modal ===
    function openModal(modal) { 
        if (modal) modal.classList.remove('hidden'); 
    }
    function closeModal(modal) { 
        if (modal) modal.classList.add('hidden'); 
    }

    // Tutup modal saat klik area luar
    window.addEventListener('click', function(e) {
        [modalTambah, modalEdit, modalHapus].forEach(m => {
            if (e.target === m) closeModal(m);
        });
    });

    // === FORM EDIT ===
    const editForm = document.getElementById('edit-category-form');
    const editName = document.getElementById('edit-name');
    const editDescription = document.getElementById('edit-description');
    const editStatusActive = document.getElementById('edit-status-active');
    const editStatusInactive = document.getElementById('edit-status-inactive');
    const editProductsCount = document.getElementById('edit-products-count');
    const editProductsList = document.getElementById('edit-products-list');

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.categoryId;
            const name = btn.dataset.categoryName;
            const desc = btn.dataset.categoryDescription;
            const status = btn.dataset.categoryStatus;
            const productsCount = parseInt(btn.dataset.productsCount);
            const products = JSON.parse(btn.dataset.products || '[]');

            // Set form action
            editForm.action = `/admin/categories/${id}`;
            editName.value = name || '';
            editDescription.value = desc || '';
            editStatusActive.checked = status === 'active';
            editStatusInactive.checked = status === 'inactive';

            // Update produk list
            editProductsCount.textContent = productsCount;
            editProductsList.innerHTML = '';
            if (products.length > 0) {
                products.forEach(p => {
                    const li = document.createElement('li');
                    li.textContent = p;
                    editProductsList.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = 'Belum ada produk dalam kategori ini.';
                li.classList.add('text-gray-500', 'italic');
                editProductsList.appendChild(li);
            }

            openModal(modalEdit);
        });
    });

    // === FORM HAPUS ===
    const deleteForm = document.getElementById('delete-form');
    const categoryNameHapus = document.getElementById('category-name-hapus');
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.categoryId;
            const name = btn.dataset.categoryName;

            deleteForm.action = `/admin/categories/${id}`;
            categoryNameHapus.textContent = name;
            openModal(modalHapus);
        });
    });

    // === TOMBOL BUKA / TUTUP (data-modal-toggle) ===
    document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            // Ambil ID modal dari 'data-modal-toggle'
            const modalId = btn.dataset.modalToggle;
            const target = document.getElementById(modalId);

            if (target) {
                // Cek apakah tombol ini punya 'data-modal-target'
                // JIKA IYA: Ini adalah tombol BUKA (seperti "Add Category")
                // JIKA TIDAK: Ini adalah tombol TUTUP (seperti 'X' atau 'Batal')
                if (btn.dataset.modalTarget) {
                    openModal(target); // Buka modal
                } else {
                    closeModal(target); // Tutup modal
                }
            }
        });
    });

    // === Validasi Error (tampilkan modal otomatis) ===
    @if ($errors->any())
        @if (session('error_modal_type') === 'create')
            openModal(modalTambah);
        @elseif (session('error_modal_type') === 'edit')
            openModal(modalEdit);
        @endif
    @endif
});
</script>
@endpush