@extends('layouts.admin')

@section('content')

<!-- 🔹 Section 1 -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">Dashboard</h3>
    <p class="text-gray-600">Welcome back, Panacea! Here is a summary of Hygeia's current condition.</p>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Pending Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">New Registrations</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Low Stock Alerts</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 Section 2 -->
<section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

    <!-- 🔹 Analisis Penjualan -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Sales Analytics</h3>
                <p class="text-sm text-gray-500">Tren penjualan 30 hari terakhir</p>
            </div>
            <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
                <button class="px-3 py-1 rounded-lg text-sm font-medium text-gray-500">7 Hari</button>
                <button class="px-3 py-1 rounded-lg text-sm font-medium bg-white text-gray-800 shadow">30 Hari</button>
            </div>
        </div>
        
        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-gray-400">[Placeholder untuk Line Chart]</p>
            </div>
        
        <div class="flex justify-center space-x-6 mt-4">
            <div class="flex items-center text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-green-400 mr-2"></span>
                Revenue Harian
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                Tren Naik
            </div>
        </div>
    </div>

    <!-- 🔹 Analisis Ststus Produk -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800">Product Status</h3>
        <p class="text-sm text-gray-500 mb-4">Distribusi status produk di toko</p>
        
        <div class="relative h-48 flex items-center justify-center my-4">
            <div class="w-44 h-44 rounded-full" style="background-image: conic-gradient(from 0deg, #F87171 0% 25%, #34D399 25% 100%);">
            </div>
            <div class="absolute w-36 h-36 rounded-full bg-white"></div>
            
            <div class="absolute flex flex-col items-center justify-center">
                <span class="text-3xl font-bold text-red-600">1,247</span>
                <span class="text-sm text-gray-500">Total Produk</span>
            </div>
        </div>

        <div class="space-y-2 mt-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600">Active</span>
                </div>
                <span class="text-sm font-medium text-gray-800">75%</span>
                <span class="text-sm text-gray-500">935 produk</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600">Inactive</span>
                </div>
                <span class="text-sm font-medium text-gray-800">25%</span>
                <span class="text-sm text-gray-500">312 produk</span>
            </div>
        </div>

        <hr class="my-4 border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Produk Terlaris</p>
                <p class="text-sm text-gray-500">Stok Menipis</p>
            </div>
            <div class="text-right">
                <a href="#" class="text-sm font-medium text-teal-500 hover:underline">Termometer Digital</a>
                <p class="text-sm text-red-500 font-medium">15 produk</p>
            </div>
        </div>
    </div>

    <!-- 🔹 Analisis Penjualan perhari -->
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Recent Orders</h3>
                <p class="text-sm text-gray-500">5 pesanan terbaru hari ini</p>
            </div>
            <a href="#" class="text-sm font-medium text-teal-500 hover:text-teal-600">
                Lihat Semua &rarr;
            </a>
        </div>
        <div class="p-4">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="pb-2 font-medium">Order ID</th>
                        <th class="pb-2 font-medium">Customer</th>
                        <th class="pb-2 font-medium">Total</th>
                        <th class="pb-2 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-t border-gray-200">
                        <td class="py-3 pr-2">
                            <p class="font-medium text-gray-800">ORD-2025-001</p>
                            <p class="text-xs text-gray-500">15 Jan 2025</p>
                        </td>
                        <td class="py-3 pr-2">Dr. Sarah Wijaya</td>
                        <td class="py-3 pr-2 font-medium">Rp 2,450,000</td>
                        <td class="py-3">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completed</span>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <td class="py-3 pr-2">
                            <p class="font-medium text-gray-800">ORD-2025-002</p>
                            <p class="text-xs text-gray-500">15 Jan 2025</p>
                        </td>
                        <td class="py-3 pr-2">RS Siloam Hospitals</td>
                        <td class="py-3 pr-2 font-medium">Rp 15,750,000</td>
                        <td class="py-3">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pending</span>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <td class="py-3 pr-2">
                            <p class="font-medium text-gray-800">ORD-2025-003</p>
                            <p class="text-xs text-gray-500">14 Jan 2025</p>
                        </td>
                        <td class="py-3 pr-2">Klinik Pratama Sehat</td>
                        <td class="py-3 pr-2 font-medium">Rp 3,200,000</td>
                        <td class="py-3">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Processing</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="my-4 border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Produk Terlaris</p>
                    <p class="text-sm text-gray-500">Stok Menipis</p>
                </div>
                <div class="text-right">
                    <a href="#" class="text-sm font-medium text-teal-500 hover:underline">Termometer Digital</a>
                    <p class="text-sm text-red-500 font-medium">15 produk</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Analisis Ulasan -->
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Recent Reviews</h3>
                <p class="text-sm text-gray-500">Ulasan terbaru dari pelanggan</p>
            </div>
            <a href="#" class="text-sm font-medium text-teal-500 hover:text-teal-600">
                Lihat Semua &rarr;
            </a>
        </div>
        <div class="p-4 divide-y divide-gray-200">
            <div class="py-3">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-sm font-semibold text-gray-800">Dr. Sarah Wijaya</p>
                    <span class="text-xs text-gray-400">2 jam lalu</span>
                </div>
                <p class="text-xs text-gray-500 mb-1">Termometer Digital Infrared</p>
                <div class="flex items-center mb-1">
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <span class="text-xs text-gray-500 ml-1">(5/5)</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed truncate">
                    Sangat akurat dan mudah digunakan untuk pemeriksaa...
                </p>
            </div>
            <div class="py-3">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-sm font-semibold text-gray-800">Ns. Maria Sari</p>
                    <span class="text-xs text-gray-400">4 jam lalu</span>
                </div>
                <p class="text-xs text-gray-500 mb-1">Stetoskop Littmann Classic</p>
                <div class="flex items-center mb-1">
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.09l6.572-.955L10 0l2.939 6.135 6.572.955-4.756 4.455 1.123 6.545z" /></svg>
                    <span class="text-xs text-gray-500 ml-1">(5/5)</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed truncate">
                    Kualitas suara sangat jernih, sangat membantu dalam...
                </p>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Produk Terlaris</p>
                    <p class="text-sm text-gray-500">Stok Menipis</p>
                </div>
                <div class="text-right">
                    <a href="#" class="text-sm font-medium text-teal-500 hover:underline">Termometer Digital</a>
                    <p class="text-sm text-red-500 font-medium">15 produk</p>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
