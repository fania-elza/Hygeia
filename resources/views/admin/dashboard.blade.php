@extends('admin.layouts.app')

@section('content')

<!-- 🔹 Section 1 -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">Overview</h3>
    <p class="text-gray-600">Selamat datang di portal admin Hygeia. Ini adalah tampilan ringkasan data harian sistem Anda.</p>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Products</p>
            <h4 class="text-2xl font-bold text-teal-600">1,247</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">3,891</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Customers</p>
            <h4 class="text-2xl font-bold text-teal-600">2,156</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h4 class="text-2xl font-bold text-teal-600">$89,247</h4>
        </div>
    </div>
</section>

<!-- 🔹 Section 2 -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
    <table class="min-w-full border border-gray-300 text-left text-sm">
        <thead class="bg-teal-600 text-white">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Order ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer</th>
                <th class="border border-gray-300 px-4 py-2">Total</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2">ORD-001</td>
                <td class="border border-gray-300 px-4 py-2">Dr. Sarah Johnson</td>
                <td class="border border-gray-300 px-4 py-2">$245.00</td>
                <td class="border border-gray-300 px-4 py-2 text-green-600 font-medium">Completed</td>
                <td class="border border-gray-300 px-4 py-2">2025-01-15</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2">ORD-002</td>
                <td class="border border-gray-300 px-4 py-2">Michael Chen</td>
                <td class="border border-gray-300 px-4 py-2">$189.50</td>
                <td class="border border-gray-300 px-4 py-2 text-blue-600 font-medium">Processing</td>
                <td class="border border-gray-300 px-4 py-2">2025-01-15</td>
            </tr>
        </tbody>
    </table>
</section>

@endsection
