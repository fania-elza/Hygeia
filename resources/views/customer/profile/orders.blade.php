<!-- Blade template for customer orders, corrected without altering styling -->
@extends('layouts.store')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">

        <!-- Sidebar -->
        <aside class="md:w-1/4 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-green-500 text-white flex items-center justify-center text-3xl font-bold mb-3">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>

                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('store.profile.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-person-fill text-lg"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('store.profile.orders') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-50 text-green-600 font-semibold">
                                <i class="bi bi-box-seam text-lg"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-geo-alt text-lg"></i>
                                <span>Alamat Pengiriman</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-bell text-lg"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-question-circle text-lg"></i>
                                <span>Bantuan & Dukungan</span>
                            </a>
                        </li>
                    </ul>

                    <hr class="my-6 border-gray-200">

                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                    <i class="bi bi-box-arrow-left text-lg"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content: Pesanan Saya -->
        <main class="md:w-3/4">
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Pesanan Saya</h1>

                <div class="space-y-6">
                    @forelse ($orders as $order)
                    <div class="border border-gray-100 rounded-xl p-5 hover:shadow-md transition">

                        <div class="flex flex-col md:flex-row justify-between md:items-center mb-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $order->order_number }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d F Y') }}</p>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-2 md:mt-0">
                                <span class="px-3 py-1 text-sm rounded-full font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-600
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-600
                                    @elseif($order->status === 'completed') bg-green-100 text-green-600
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-600
                                    @endif">{{ ucfirst($order->status) }}</span>

                                <span class="px-3 py-1 text-sm rounded-full font-medium
                                    @if($order->payment_status === 'paid') bg-green-100 text-green-600
                                    @else bg-gray-100 text-gray-500
                                    @endif">{{ ucfirst($order->payment_status) }}</span>
                            </div>

                            <div class="text-right mt-2 md:mt-0">
                                <p class="font-bold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500">{{ strtoupper($order->payment_method) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 border-t border-gray-100 pt-4 flex-wrap">
                            @foreach ($order->orderItems as $item)
                            <div class="flex items-center gap-4">
                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}" class="w-12 h-12 object-cover rounded-md border">
                                <div class="flex flex-col">
                                    <p class="text-gray-800">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }}x</p>
                                </div>
                            </div>
                            @endforeach

                            <a href="{{ route('store.profile.orders.detail', $order->id) }}" class="ml-auto bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @empty
                        <p class="text-gray-500 text-center py-10">Belum ada pesanan.</p>
                    @endforelse
                </div>

            </div>
        </main>

    </div>
</div>
@endsection