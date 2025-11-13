@extends('layouts.admin')

@section('content')

<!-- 🔹 SECTION: Statistik Kategori -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Orders Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Completed Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Pending Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 Search & Filter Section -->
<div class="flex items-center justify-between w-full mx-auto p-2 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            placeholder="Search orders......" 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500">
        <button type="button" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </div>

    <button class="flex items-center justify-center flex-shrink-0 ml-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-800 hover:bg-gray-50 focus:ring-2 focus:outline-none focus:ring-blue-300">
        <span>All Status</span>
        <svg class="w-4 h-4 text-gray-600 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
</div>

<!-- 🔹 SECTION: Table -->
<section class="bg-white shadow rounded-lg p-6 mt-4">

    <table class="min-w-full border border-teal-200 text-left text-sm">
        <thead class="bg-teal-50 text-gray-800 text-center">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Order ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                <th class="border border-gray-300 px-4 py-2">Total Amount</th>
                <th class="border border-gray-300 px-4 py-2">Payment Method</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Payment Method</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-center text-gray-700">
            <tr>
                <td class="border border-gray-300 px-4 py-2">KT001</td>
                <td class="border border-gray-300 px-4 py-2">Elektronik</td>
                <td class="border border-gray-300 px-4 py-2">Peralatan elektronik rumah tangga</td>
                <td class="border border-gray-300 px-4 py-2">Cash</td>
                <td class="border border-gray-300 px-4 py-2">45</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                        Aktif
                    </span>
                </td>                
                <td class="border border-gray-300 px-4 py-2">
                    <!-- 🔸 Tombol Detail -->
                    <button 
                        data-modal-target="modal-detailorder" 
                        data-modal-toggle="modal-detailorder"
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
                <td class="border border-gray-300 px-4 py-2">Cash</td>
                <td class="border border-gray-300 px-4 py-2">45</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">
                        Nonaktif
                    </span>
                </td>                
                <td class="border border-gray-300 px-4 py-2">
                    <!-- 🔸 Tombol Edit -->
                    <button 
                        data-modal-target="modal-detailorder" 
                        data-modal-toggle="modal-detailorder"
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

<!-- 🔹 MODAL: Detail Pesanan -->
<div id="modal-detailorder" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
  <div class="relative p-4 w-full max-w-xl">
    <div class="relative bg-white rounded-lg shadow-lg">
      
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Order Details</h3>
        <button type="button" data-modal-toggle="modal-detailorder" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13"/>
          </svg>
        </button>
      </div>

      <!-- Body -->
      <div class="p-5 space-y-4">
        <!-- Order & Customer Info -->
        <div class="bg-teal-50 border border-teal-200 rounded-xl p-5">
          <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
            <div>
              <h5 class="text-sm font-semibold mb-1">Order Information</h5>
              <p><span class="font-medium">Order ID:</span> ORD-001</p>
              <p><span class="font-medium">Date:</span> 2025-01-15</p>
              <p><span class="font-medium">Payment:</span> Transfer Bank</p>
            </div>
            <div>
              <h5 class="text-sm font-semibold mb-1">Customer Information</h5>
              <p><span class="font-medium">Name:</span> Dr. Sarah Wijaya</p>
              <p><span class="font-medium">Email:</span> sarah.wijaya@email.com</p>
              <p><span class="font-medium">Address:</span> Jl. Sudirman No. 123, Jakarta Pusat</p>
            </div>
          </div>
        </div>

        <!-- Ordered Products -->
        <div>
          <h5 class="text-base font-semibold text-gray-900 mb-2">Ordered Products</h5>
          <div class="space-y-2">
            <div class="flex justify-between items-center p-3 bg-gray-50 border border-gray-200 rounded-lg">
              <div>
                <p class="font-medium text-gray-800">Paracetamol 500mg</p>
                <p class="text-sm text-gray-500">Quantity: 2 × Rp 15.000</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 30.000</p>
              </div>
            </div>

            <div class="flex justify-between items-center p-3 bg-gray-50 border border-gray-200 rounded-lg">
              <div>
                <p class="font-medium text-gray-800">Vitamin C 1000mg</p>
                <p class="text-sm text-gray-500">Quantity: 1 × Rp 85.000</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 85.000</p>
              </div>
            </div>

            <div class="flex justify-between items-center p-3 bg-gray-50 border border-gray-200 rounded-lg">
              <div>
                <p class="font-medium text-gray-800">Amoxicillin 500mg</p>
                <p class="text-sm text-gray-500">Quantity: 3 × Rp 45.000</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 135.000</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Amount -->
        <div class="flex justify-between items-center pt-3 border-t border-gray-200">
          <p class="font-semibold text-gray-900">Total Amount:</p>
          <p class="text-lg font-bold text-gray-900">Rp 245.000</p>
        </div>

        <!-- Update Status -->
        <div class="pt-2">
          <label for="order-status" class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
          <select id="order-status" name="status" class="border border-gray-300 rounded-lg text-sm p-2 w-full focus:ring-2 focus:ring-teal-400 focus:outline-none">
            <option value="Completed" selected>Completed</option>
            <option value="Processing">Processing</option>
            <option value="Pending">Pending</option>
            <option value="Cancelled">Cancelled</option>
          </select>
        </div>
      </div>

      <!-- Footer -->
      <div class="flex justify-end items-center gap-3 p-4 border-t border-gray-200">
        <button data-modal-toggle="modal-detailorder" type="button" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
          Close
        </button>
        <button type="button" class="px-4 py-2 rounded-lg bg-teal-500 hover:bg-green-700 text-white font-medium">
          Save Changes
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
