@extends('layouts.admin')

@section('content')

<!-- 🔹 Section 1: Statistik Utama -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">Dashboard</h3>
    <p class="text-gray-600">Welcome back, Panacea! Here is a summary of Hygeia's current condition.</p>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <!-- Total Revenue -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h4 class="text-2xl font-bold text-teal-600">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h4>
        </div>

        <!-- Order Status Box -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            {{-- Label --}}
            <p class="text-sm text-gray-500">Order Diproses</p>

            {{-- Count --}}
            <h4 class="text-2xl font-bold text-teal-600 mt-1">
                {{ $processedOrders }}
            </h4>
        </div>

        <!-- New Registrations (last 30 days) -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">New Registrations</p>
            <h4 class="text-2xl font-bold text-teal-600">
                {{ $newRegistrations ?? 0 }}
            </h4>
        </div>

        <!-- Low Stock Alerts -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Low Stock Alerts</p>
            <h4 class="text-2xl font-bold text-teal-600">
                {{ $lowStockAlerts }}
            </h4>
        </div>
    </div>
</section>

<!-- 🔹 Section 2: Analisis -->
<section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- 🔹 Product Status -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800">Product Status</h3>
        <p class="text-sm text-gray-500 mb-4">Distribusi status produk di toko</p>
        
        <div class="relative h-48 flex items-center justify-center my-4">
            <div class="w-44 h-44 rounded-full" style="background-image: conic-gradient(from 0deg, #34D399 0% {{ $activePercent }}%, #F87171 {{ $activePercent }}% 100%);"></div>
            <div class="absolute w-36 h-36 rounded-full bg-white"></div>
            
            <div class="absolute flex flex-col items-center justify-center">
                <span class="text-3xl font-bold text-gray-800">{{ $products->count() }}</span>
                <span class="text-sm text-gray-500">Total Produk</span>
            </div>
        </div>

        <div class="space-y-2 mt-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600">Active</span>
                </div>
                <span class="text-sm font-medium text-gray-800">{{ $activePercent }}%</span>
                <span class="text-sm text-gray-500">{{ $products->where('status', true)->count() }} produk</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600">Inactive</span>
                </div>
                <span class="text-sm font-medium text-gray-800">{{ 100 - $activePercent }}%</span>
                <span class="text-sm text-gray-500">{{ $products->where('status', false)->count() }} produk</span>
            </div>
        </div>
    </div>
</section>

{{-- Dropdown Toggle & Pilih Status --}}
{{-- Dropdown Toggle & Pilih Status --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const btn = document.getElementById("dropdownButton");
        const menu = document.getElementById("dropdownMenu");
        const statusLabel = document.getElementById("statusLabel");
        const selectedSpan = document.getElementById("selectedStatus");

        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            menu.classList.toggle("hidden");
        });

        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const status = link.dataset.status;
                statusLabel.textContent = status;      // ubah label di bawah
                selectedSpan.textContent = status;     // ubah teks di button
                menu.classList.add("hidden");          // tutup menu
            });
        });

        // Klik di luar dropdown → tutup menu
        document.addEventListener("click", function (e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add("hidden");
            }
        });
    });
</script>
@endsection
