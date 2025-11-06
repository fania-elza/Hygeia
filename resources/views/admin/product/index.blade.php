@extends('layouts.admin')

@section('content')

<!-- 🔹 Section 1 -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Product Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Produk</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Peringatan Stok Rendah</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Kategori</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Nilai Total Persediaan</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 Search & Filter Section -->
<div class="flex items-center justify-between w-full mx-auto p-2 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            placeholder="Cari produk..." 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500">
        <button type="button" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </div>

    <button class="flex items-center justify-center flex-shrink-0 ml-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-blue-300">
        <span>All Categories</span>
        <svg class="w-4 h-4 text-gray-600 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
</div>

<!-- 🔹 Section 2 -->
<section class="bg-white shadow rounded-lg p-6">
    <button 
        data-modal-target="modal-tambahproduk" 
        data-modal-toggle="modal-tambahproduk" 
        type="button"
        class="mb-3 flex items-center space-x-1 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" />
        </svg>
        <span>Tambah Produk</span>
    </button>

    <table class="min-w-full border border-teal-200 text-left text-sm">
        <thead class="bg-teal-50 text-dark text-center border border-teal-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID Produk</th>
                <th class="border border-gray-300 px-4 py-2">Gambar</th>
                <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                <th class="border border-gray-300 px-4 py-2">Kategori</th>
                <th class="border border-gray-300 px-4 py-2">Total</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Aktivitas</th>
            </tr>
        </thead>
        <tbody class="text-center text-gray-700">
            <tr>
                <td class="border border-gray-300 px-4 py-2">PR001</td>
                <td class="border border-gray-300 px-4 py-2">
                    <div class="w-12 h-12 bg-gray-200 rounded-lg mx-auto flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </td>
                <td class="border border-gray-300 px-4 py-2">Paracetamol</td>
                <td class="border border-gray-300 px-4 py-2">Demam</td>
                <td class="border border-gray-300 px-4 py-2">10</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                        Aktif
                    </span>
                </td>                
                <td class="border border-gray-300 px-4 py-2">
                    <!-- 🔸 Tombol Edit -->
                    <button 
                        data-modal-target="modal-editproduk" 
                        data-modal-toggle="modal-editproduk"
                        data-product-id="PR001"
                        data-product-name="Paracetamol"
                        data-product-category="Demam"
                        data-product-price="15000"
                        data-product-stock="10"
                        data-product-description="Obat untuk meredakan demam dan sakit kepala"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200 edit-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="#3B82F6" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                    </button>

                    <!-- 🔸 Tombol Hapus -->
                    <button 
                        data-modal-target="modal-hapus" 
                        data-modal-toggle="modal-hapus"
                        data-product-id="PR001"
                        data-product-name="Paracetamol"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-red-500 hover:text-red-600 hover:bg-red-50 
                                transition-colors duration-200 delete-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#EF4444" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<!-- 🔹 MODAL: Tambah Produk -->
<div id="modal-tambahproduk" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Produk Baru</h3>
                <button type="button" data-modal-toggle="modal-tambahproduk" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>

            <form class="p-4">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama produk">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select class="w-full p-2 border border-gray-300 rounded-lg text-sm">
                        <option value="">Pilih Kategori</option>
                        <option value="Demam">Demam</option>
                        <option value="Batuk">Batuk</option>
                        <option value="Suplemen">Suplemen</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">
                            Harga (Rp)
                        </label>
                        <input 
                            type="number" 
                            id="harga" 
                            name="harga" 
                            class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                            placeholder="Masukkan harga"
                        >
                    </div>
                    <div>
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">
                            Persediaan
                        </label>
                        <input 
                            type="number" 
                            id="stok" 
                            name="stok" 
                            class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                            placeholder="Masukkan stok"
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">
                        Deskripsi
                    </label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="3"
                        class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                        placeholder="Masukkan deskripsi produk"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Gambar Produk</label>
                    <div 
                        id="dropzone-tambah"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <input 
                            id="file-upload-tambah" 
                            type="file" 
                            name="gambar" 
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
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Simpan Produk
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 MODAL: Edit Produk (DIPERBAIKI) -->
<div id="modal-editproduk" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
                <button type="button" data-modal-toggle="modal-editproduk" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>
            <form class="p-4">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                    <input type="text" id="edit-nama-produk" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama produk">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select id="edit-kategori" class="w-full p-2 border border-gray-300 rounded-lg text-sm">
                        <option value="">Pilih Kategori</option>
                        <option value="Demam">Demam</option>
                        <option value="Batuk">Batuk</option>
                        <option value="Suplemen">Suplemen</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="edit-harga" class="block mb-2 text-sm font-medium text-gray-900">
                            Harga (Rp)
                        </label>
                        <input 
                            type="number" 
                            id="edit-harga" 
                            name="harga" 
                            class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                            placeholder="Masukkan harga"
                        >
                    </div>
                    <div>
                        <label for="edit-stok" class="block mb-2 text-sm font-medium text-gray-900">
                            Persediaan
                        </label>
                        <input 
                            type="number" 
                            id="edit-stok" 
                            name="stok" 
                            class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                            placeholder="Masukkan stok"
                        >
                    </div>
                </div>
                <div class="mb-4">
                    <label for="edit-deskripsi" class="block mb-2 text-sm font-medium text-gray-900">
                        Deskripsi
                    </label>
                    <textarea 
                        id="edit-deskripsi" 
                        name="deskripsi" 
                        rows="3"
                        class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" 
                        placeholder="Masukkan deskripsi produk"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Gambar Produk</label>
                    <div 
                        id="dropzone-edit"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <input 
                            id="file-upload-edit" 
                            type="file" 
                            name="gambar" 
                            accept="image/*" 
                            class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="mb-2">
                            <path fill="#6B7280" d="M5 3h13a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m0 1a2 2 0 0 0-2 2v11.59l4.29-4.3l2.5 2.5l5-5L20 16V6a2 2 0 0 0-2-2zm4.79 13.21l-2.5-2.5L3 19a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-1.59l-5.21-5.2zM7.5 6A2.5 2.5 0 0 1 10 8.5A2.5 2.5 0 0 1 7.5 11A2.5 2.5 0 0 1 5 8.5A2.5 2.5 0 0 1 7.5 6m0 1A1.5 1.5 0 0 0 6 8.5A1.5 1.5 0 0 0 7.5 10A1.5 1.5 0 0 0 9 8.5A1.5 1.5 0 0 0 7.5 7"/>
                        </svg>
                        <p class="text-sm text-gray-600"><span class="font-medium text-teal-600">Klik untuk upload</span> atau drag and drop</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG maksimal 5MB</p>
                    </div>
                    <div id="preview-container-edit" class="mt-3 hidden">
                        <img id="image-preview-edit" class="w-32 h-32 object-cover rounded-lg border border-gray-200" alt="Preview">
                    </div>
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 MODAL: Hapus Produk -->
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
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Produk</h3>
                <p class="text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus produk 
                    <span class="font-semibold text-gray-900" id="product-name-hapus">Paracetamol</span> 
                    (<span class="text-gray-500" id="product-id-hapus">PR001</span>)?
                </p>
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg mb-4">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Tindakan ini tidak dapat dibatalkan. Semua data produk akan dihapus secara permanen.
                </p>
                
                <div class="flex justify-center space-x-3">
                    <button 
                        type="button" 
                        data-modal-toggle="modal-hapus"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-gray-200 transition-colors">
                        Batal
                    </button>
                    <button 
                        type="button" 
                        id="confirm-delete"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== MODAL EDIT FUNGSIONALITAS =====
    const editButtons = document.querySelectorAll('.edit-btn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari atribut data
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productCategory = this.getAttribute('data-product-category');
            const productPrice = this.getAttribute('data-product-price');
            const productStock = this.getAttribute('data-product-stock');
            const productDescription = this.getAttribute('data-product-description');
            
            console.log('Edit button clicked:', {
                productId,
                productName,
                productCategory,
                productPrice,
                productStock,
                productDescription
            });
            
            // Isi form dengan data produk
            document.getElementById('edit-nama-produk').value = productName;
            document.getElementById('edit-kategori').value = productCategory;
            document.getElementById('edit-harga').value = productPrice;
            document.getElementById('edit-stok').value = productStock;
            document.getElementById('edit-deskripsi').value = productDescription;
            
            // Tampilkan modal edit
            const modalEdit = document.getElementById('modal-editproduk');
            modalEdit.classList.remove('hidden');
        });
    });

    // ===== UPLOAD GAMBAR UNTUK MODAL TAMBAH =====
    const dropzoneTambah = document.getElementById('dropzone-tambah');
    const fileInputTambah = document.getElementById('file-upload-tambah');
    const previewContainerTambah = document.getElementById('preview-container-tambah');
    const imagePreviewTambah = document.getElementById('image-preview-tambah');

    if (dropzoneTambah) {
        dropzoneTambah.addEventListener('click', () => fileInputTambah.click());
        setupDropzone(dropzoneTambah, fileInputTambah, imagePreviewTambah, previewContainerTambah);
    }

    // ===== UPLOAD GAMBAR UNTUK MODAL EDIT =====
    const dropzoneEdit = document.getElementById('dropzone-edit');
    const fileInputEdit = document.getElementById('file-upload-edit');
    const previewContainerEdit = document.getElementById('preview-container-edit');
    const imagePreviewEdit = document.getElementById('image-preview-edit');

    if (dropzoneEdit) {
        dropzoneEdit.addEventListener('click', () => fileInputEdit.click());
        setupDropzone(dropzoneEdit, fileInputEdit, imagePreviewEdit, previewContainerEdit);
    }

    // ===== FUNGSI UNTUK SETUP DROPZONE =====
    function setupDropzone(dropzone, fileInput, previewElement, containerElement) {
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('bg-gray-100', 'border-teal-500');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-gray-100', 'border-teal-500');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-gray-100', 'border-teal-500');
            const file = e.dataTransfer.files[0];
            handleFile(file, previewElement, containerElement);
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handleFile(file, previewElement, containerElement);
        });
    }

    function handleFile(file, previewElement, containerElement) {
        if (!file) return;
        
        if (!file.type.startsWith('image/')) {
            alert('Silakan upload file gambar.');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) {
            alert('File terlalu besar! Maksimal 5MB.');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = (e) => {
            previewElement.src = e.target.result;
            containerElement.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    // ===== MODAL HAPUS FUNGSIONALITAS =====
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const productNameElement = document.getElementById('product-name-hapus');
    const productIdElement = document.getElementById('product-id-hapus');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    
    let productToDelete = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            
            productToDelete = productId;
            productNameElement.textContent = productName;
            productIdElement.textContent = productId;
        });
    });

    confirmDeleteButton.addEventListener('click', function() {
        if (productToDelete) {
            // Simulasi proses hapus
            const originalText = this.innerHTML;
            this.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menghapus...
            `;
            this.disabled = true;
            
            setTimeout(() => {
                const modal = document.getElementById('modal-hapus');
                modal.classList.add('hidden');
                this.innerHTML = originalText;
                this.disabled = false;
                alert(`Produk ${productNameElement.textContent} berhasil dihapus!`);
            }, 1500);
        }
    });

    // ===== TUTUP MODAL SAAT KLIK DI LUAR =====
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('fixed')) {
            e.target.classList.add('hidden');
        }
    });

    console.log('Modal edit script loaded successfully');
});
</script>