@extends('layouts.admin')

@section('content')

<!-- 🔹 SECTION: Statistik Kategori -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Reviews Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Reviews</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Average Rating</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Positive Feedback</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Featured Reviews</p>
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

    <table class="min-w-full border border-teal-200 text-left text-sm">
        <thead class="bg-teal-50 text-gray-800 text-center">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Review ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                <th class="border border-gray-300 px-4 py-2">Product</th>
                <th class="border border-gray-300 px-4 py-2">Rating</th>
                <th class="border border-gray-300 px-4 py-2">Review Date</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
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
                        data-modal-target="modal-detailreview" 
                        data-modal-toggle="modal-detailreview"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><defs><mask id="SVG544unEnd"><g fill="#1a1a1a" 
                            stroke="#fff" stroke-linejoin="round" stroke-width="4"><path d="M24 36c11.046 0 20-12 20-12s-8.954-12-20-12S4 24 4 24s8.954 12 20 12Z"/>
                            <path d="M24 29a5 5 0 1 0 0-10a5 5 0 0 0 0 10Z"/></g></mask></defs><path fill="#3B82F6" d="M0 0h48v48H0z" mask="url(#SVG544unEnd)"/>
                        </svg>
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
                        data-modal-target="modal-detailreview" 
                        data-modal-toggle="modal-detailreview"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg 
                                text-blue-500 hover:text-blue-600 hover:bg-blue-50 
                                transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><defs><mask id="SVG544unEnd"><g fill="#808080" 
                            stroke="#fff" stroke-linejoin="round" stroke-width="4"><path d="M24 36c11.046 0 20-12 20-12s-8.954-12-20-12S4 24 4 24s8.954 12 20 12Z"/>
                            <path d="M24 29a5 5 0 1 0 0-10a5 5 0 0 0 0 10Z"/></g></mask></defs><path fill="#3B82F6" d="M0 0h48v48H0z" mask="url(#SVG544unEnd)"/></svg>
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

<!-- 🔹 MODAL: Detail Review-->
<div id="modal-detailreview" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
    <div class="relative p-0 w-full max-w-md"> <div class="relative bg-white rounded-lg shadow-lg">
            
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Detail Ulasan Pelanggan
                </h3>
                <button type="button" data-modal-toggle="modal-detailreview" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13" />
                    </svg>
                </button>
            </div>
            
            <div class="p-5 space-y-5"> <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A1.875 1.875 0 0 1 17.25 22.5H6.75a1.875 1.875 0 0 1-2.249-2.382Z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Dr. Sarah Wijaya</p>
                        <p class="text-sm text-gray-500">sarah.wijaya@rsudarma.co.id</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</label>
                    <p class="text-base font-medium text-gray-800 mt-1">Termometer Digital Infrared</p>
                    <p class="text-sm text-gray-500">Alat Pemeriksaan</p>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</label>
                    <div class="flex items-center mt-1">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" />
                        </svg>
                        <span class="ml-2 text-sm font-medium text-gray-700">(5/5)</span>
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Ulasan Lengkap</label>
                    <div class="mt-1 bg-gray-50 border border-gray-200 rounded-lg p-3">
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Termometer ini sangat akurat dan mudah digunakan. Hasil pengukuran cepat dan konsisten. Sangat membantu untuk pemeriksaan rutin pasien di rumah sakit kami. Build quality juga sangat baik dan tahan lama.
                        </p>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Submit</label>
                        <p class="text-sm text-gray-700 mt-1">Minggu, 15 Desember 2024</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4.5a2.5 2.5 0 0 1 5 0v5.879a.5.5 0 0 1-.146.354l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5A.5.5 0 0 1 2 10.379V4.5A2.5 2.5 0 0 1 5 4.5z" />
                                <path d="M11.5 6.5a.5.5 0 0 0-1 0v4.379a.5.5 0 0 0 .146.354l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0 .146-.354V6.5a.5.5 0 0 0-1 0v4.086l-3.146 3.147L11.5 10.586V6.5z" />
                            </svg>s
                            Ulasan Unggulan
                        </span>
                    </div>
                </div>

            </div>
            
            <div class="flex items-center justify-end space-x-3 p-4 border-t border-gray-200 rounded-b-lg">
                <button type="button" class="flex items-center justify-center text-sm font-medium px-4 py-2 rounded-lg bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 4.5a2.5 2.5 0 0 1 5 0v5.879a.5.5 0 0 1-.146.354l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5A.5.5 0 0 1 2 10.379V4.5A2.5 2.5 0 0 1 5 4.5z" />
                        <path d="M11.5 6.5a.5.5 0 0 0-1 0v4.379a.5.5 0 0 0 .146.354l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0 .146-.354V6.5a.5.5 0 0 0-1 0v4.086l-3.146 3.147L11.5 10.586V6.5z" />
                    </svg>
                    Hapus dari Unggulan
                </button>
                <button type="button" class="flex items-center justify-center text-sm font-medium px-4 py-2 rounded-lg text-white bg-red-600 hover:bg-red-700">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a1 1 0 0 0 0 2h12a1 1 0 0 0 0-2h-2a1 1 0 0 0-1-1H9zM3 7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z" clip-rule="evenodd" />
                    </svg>
                    Hapus Ulasan
                </button>
            </div>
            
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
