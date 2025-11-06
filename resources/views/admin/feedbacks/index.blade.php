@extends('layouts.admin')

@section('content')

<!-- 🔹 SECTION: Statistik Kategori -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Manajemen Ulasan</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Kategori</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Kategori Aktif</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Kategori Non-Aktif</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Produk</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 SECTION: Search & Tambah -->
<div class="flex items-center justify-between w-full mx-auto p-4 mt-6 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            placeholder="Cari kategori..." 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500"
        >
        <button type="button" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </div>
</div>

<!-- 🔹 SECTION: Table -->
<section class="bg-white shadow rounded-lg p-6 mt-4">
    <button 
        data-modal-target="modal-tambahkategori" 
        data-modal-toggle="modal-tambahkategori" 
        type="button"
        class="mb-3 flex items-center space-x-1 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" />
        </svg>
        <span>Tambah Kategori</span>
    </button>

    <table class="min-w-full border border-teal-200 text-left text-sm">
        <thead class="bg-teal-50 text-gray-800 text-center">
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID Kategori</th>
                <th class="border border-gray-300 px-4 py-2">Nama Kategori</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Total Produk</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Aktivitas</th>
            </tr>
        </thead>
        <tbody class="text-center text-gray-700">
            <tr>
                <td class="border border-gray-300 px-4 py-2">KT001</td>
                <td class="border border-gray-300 px-4 py-2">Elektronik</td>
                <td class="border border-gray-300 px-4 py-2">Peralatan elektronik rumah tangga</td>
                <td class="border border-gray-300 px-4 py-2">45</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                        Aktif
                    </span>
                </td>                
                <td class="border border-gray-300 px-4 py-2">
                    <!-- 🔸 Tombol Edit -->
                    <button 
                        data-modal-target="modal-editkategori" 
                        data-modal-toggle="modal-editkategori"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="#3B82F6" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                    </button>

                    <!-- 🔸 Tombol Hapus -->
                    <button 
                        data-modal-target="modal-hapuskategori" 
                        data-modal-toggle="modal-hapuskategori"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-red-500 hover:text-red-600 hover:bg-red-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#EF4444" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">KT001</td>
                <td class="border border-gray-300 px-4 py-2">Elektronik</td>
                <td class="border border-gray-300 px-4 py-2">Peralatan elektronik rumah tangga</td>
                <td class="border border-gray-300 px-4 py-2">45</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">
                        Nonaktif
                    </span>
                </td>                
                <td class="border border-gray-300 px-4 py-2">
                    <!-- 🔸 Tombol Edit -->
                    <button 
                        data-modal-target="modal-editkategori" 
                        data-modal-toggle="modal-editkategori"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <path fill="#3B82F6" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                    </button>

                    <!-- 🔸 Tombol Hapus -->
                    <button 
                        data-modal-target="modal-hapuskategori" 
                        data-modal-toggle="modal-hapuskategori"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-red-500 hover:text-red-600 hover:bg-red-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#EF4444" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<!-- 🔹 MODAL: Tambah Kategori-->
<div id="modal-tambahkategori" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Kategori Baru</h3>
                <button type="button" data-modal-toggle="modal-tambahkategori" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>

            <form class="p-4">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan nama kategori">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm" placeholder="Masukkan deskripsi"></textarea>
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 MODAL: Edit Kategori-->
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
            <form class="p-4">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg text-sm" value="Elektronik">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea rows="3" class="w-full p-2 border border-gray-300 rounded-lg text-sm">Peralatan elektronik rumah tangga</textarea>
                </div>
                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg text-sm px-4 py-2.5">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 MODAL: Konfirmasi Hapus Kategori-->
<div id="modal-hapuskategori" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Hapus Kategori?</h3>
        <p class="text-sm text-gray-600 mb-5">Apakah Panacea yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-center space-x-3">
            <button data-modal-toggle="modal-hapuskategori" type="button" class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800">
                Batal
            </button>
            <button type="button" class="px-4 py-2 text-sm rounded-lg bg-red-600 hover:bg-red-700 text-white">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

@endsection
