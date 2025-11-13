@extends('layouts.admin')

@section('content')

<!-- 🔹 SECTION: Statistik Kategori -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Customer Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Customers</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Active Customers</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">New Registrations</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 SECTION: Search & Tambah -->
<div class="flex items-center justify-between w-full mx-auto p-4 mt-6 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            placeholder="Search customers by name or email......" 
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
                <th class="border border-gray-300 px-4 py-2">Customer ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Total Orders</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
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
                    <!-- 🔸 Tombol Detail -->
                    <button 
                        data-modal-target="modal-detailcustomer" 
                        data-modal-toggle="modal-detailcustomer"
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
                        data-modal-target="modal-editkategori" 
                        data-modal-toggle="modal-editkategori"
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
        </tbody>
    </table>
</section>

<!-- 🔹 MODAL: Detail Pelanggan -->
<div id="modal-detailcustomer" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
  <div class="relative p-4 w-full max-w-lg">
    <div class="relative bg-white rounded-lg shadow-lg">
      
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Detail Pelanggan</h3>
        <button type="button" data-modal-toggle="modal-detailcustomer" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13"/>
          </svg>
        </button>
      </div>

      <!-- Body -->
      <div class="p-6 space-y-6">

        <!-- Customer Info + Details (1 Card) -->
        <div class="bg-teal-50 border border-teal-200 rounded-xl p-5">
        <!-- Header Info -->
        <div class="flex items-center gap-4 mb-5">
            <div class="flex-shrink-0">
            <div class="w-14 h-14 bg-teal-100 text-teal-600 flex items-center justify-center rounded-full text-xl font-bold">
                SJ
            </div>
            </div>
            <div>
            <h4 class="text-lg font-semibold text-gray-800">Dr. Sarah Johnson</h4>
            <p class="text-sm text-gray-600">sarah.johnson@email.com</p>
            <p class="text-sm text-gray-600">+62 812-3456-7890</p>
            </div>
        </div>

        <!-- Detail Info -->
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
            <div>
            <p><span class="font-semibold">ID Pelnggan:</span> CUST-001</p>
            <p><span class="font-semibold">Total Pesanan:</span> 15</p>
            </div>
            <div>
            <p><span class="font-semibold">Tanggal Lahir:</span> January 15, 2024</p>
            </div>
        </div>
        </div>


        <!-- Recent Transactions -->
        <div>
          <h5 class="text-base font-semibold text-gray-900 mb-2">Transaksi Terbaru</h5>
          <div class="space-y-2">
            <div class="flex justify-between items-center p-3 border rounded-lg">
              <div>
                <p class="font-medium text-gray-800">ORD-101</p>
                <p class="text-sm text-gray-500">10 Jan 2025</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 245.000</p>
                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Completed</span>
              </div>
            </div>

            <div class="flex justify-between items-center p-3 border rounded-lg">
              <div>
                <p class="font-medium text-gray-800">ORD-089</p>
                <p class="text-sm text-gray-500">28 Des 2024</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 189.500</p>
                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Completed</span>
              </div>
            </div>

            <div class="flex justify-between items-center p-3 border rounded-lg">
              <div>
                <p class="font-medium text-gray-800">ORD-067</p>
                <p class="text-sm text-gray-500">15 Des 2024</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 367.250</p>
                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Completed</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="flex justify-end items-center gap-3 p-4 border-t border-gray-200">
        <button data-modal-toggle="modal-detailcustomer" type="button" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
          Tutup
        </button>
        <button type="button" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium">
          Nonaktifkan Pelanggan
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
