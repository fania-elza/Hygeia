@extends('layouts.store')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container mx-auto p-4 md:p-8 min-h-screen" x-data="{ activeDetail: null, activeCancel: null }">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">

        <!-- Sidebar -->
        <aside class="md:w-1/4 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6">
                {{-- Foto Profil --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 rounded-full overflow-hidden mb-3">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-green-500 text-white flex items-center justify-center text-3xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $user->username }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>

                    {{-- Form Upload Foto Profil --}}
                    <form action="{{ route('store.profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <label class="cursor-pointer text-green-600 font-medium hover:underline">
                            Ubah Foto Profil
                            <input type="file" name="profile_photo" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </label>
                        @error('profile_photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
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
                            <a href="{{ route('store.profile.address') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-geo-alt text-lg"></i>
                                <span>Alamat Pengiriman</span>
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

        <!-- Main Content -->
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
                                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-600
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

                            <!-- Modal Detail Button -->
                            <button @click="activeDetail = {{ $order->id }}" class="ml-auto bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                Lihat Detail
                            </button>

                            <!-- Cancel Button -->
                            @if(!in_array($order->status, ['shipped', 'completed', 'cancelled']))
                            <button @click="activeCancel = {{ $order->id }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                Batalkan
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- ================== MODAL DETAIL ================== -->
                    <div x-show="activeDetail === {{ $order->id }}"
                        x-transition
                        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

                        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-3xl relative">

                            <!-- Close Button -->
                            <button @click="activeDetail = null" 
                                    class="absolute right-4 top-4 text-gray-500 hover:text-black text-xl">
                                ✕
                            </button>

                            <!-- Header -->
                            <h2 class="text-2xl font-bold mb-6">
                                Detail Pesanan {{ $order->order_number }}
                            </h2>

                            <!-- ================= STATUS PESANAN ================= -->
                            <div class="flex items-center justify-between mb-8">
                                @php
                                    $steps = [
                                        'diproses' => [
                                            'label' => 'Diproses',
                                            'icon' => '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 32 32">
                                                    <path fill="CURRENT_COLOR" d="M16 2L4 9v14l12 7l12-7V9zm0 1l11 6.488v13L16 29L5 22.488v-13zm0 1L6 10v12l10 6l10-6V10zm0 2.947c4.956 0 9 4.044 9 9.053c0 4.988-4.044 9.043-9 9.043c-4.978 0-9-4.055-9-9.043c0-5.009 4.022-9.053 9-9.053M16.002 8c-.356 0-.733.03-1.078.078l.187 3.383l-1.107-3.215a8 8 0 0 0-2.008.842l1.484 3.086l-2.265-2.563a8.2 8.2 0 0 0-1.543 1.553l2.54 2.285l-3.064-1.494a7.7 7.7 0 0 0-.832 2.008l3.225 1.137l-3.412-.207A8 8 0 0 0 8.06 16c0 .376.03.732.07 1.088l3.4-.197l-3.213 1.136c.178.712.464 1.385.83 2.018l3.067-1.494l-2.553 2.273c.444.584.96 1.118 1.553 1.543l2.256-2.55l-1.485 3.085a8 8 0 0 0 2.008.85l1.117-3.242l-.199 3.412c.356.049.734.078 1.09.078c.375 0 .73-.03 1.086-.08l-.2-3.451l1.137 3.273a8 8 0 0 0 2.008-.85l-1.482-3.076l2.254 2.551a7.6 7.6 0 0 0 1.543-1.543l-2.541-2.273l3.066 1.482a7.8 7.8 0 0 0 .83-2.025L20.49 16.89l3.393.197c.049-.356.068-.712.068-1.088s-.02-.751-.068-1.107l-3.403.207l3.213-1.127c-.188-.712-.454-1.405-.83-2.018L19.8 13.447l2.54-2.283a8.4 8.4 0 0 0-1.532-1.553l-2.264 2.56l1.473-3.073a8 8 0 0 0-2.008-.852L16.89 11.48l.199-3.402A6.6 6.6 0 0 0 16.002 8" />
                                                </svg>
                                            '
                                        ],
                                        'dikirim' => [
                                            'label' => 'Dikirim',
                                            'icon' => '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                                    <path fill="CURRENT_COLOR" d="M6 20q-1.25 0-2.125-.875T3 17H1V6q0-.825.588-1.412T3 4h14v4h3l3 4v5h-2q0 1.25-.875 2.125T18 20t-2.125-.875T15 17H9q0 1.25-.875 2.125T6 20m0-2q.425 0 .713-.288T7 17t-.288-.712T6 16t-.712.288T5 17t.288.713T6 18m-3-3h.8q.425-.45.975-.725T6 14t1.225.275T8.2 15H15V6H3zm15 3q.425 0 .713-.288T19 17t-.288-.712T18 16t-.712.288T17 17t.288.713T18 18m-1-5h4.25L19 10h-2zm-8-2.5" />
                                                </svg>
                                            '
                                        ],
                                        'selesai' => [
                                            'label' => 'Selesai',
                                            'icon' => '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                                    <path fill="CURRENT_COLOR" d="M1.75 13.05q-.3-.3-.288-.7t.313-.7q.3-.275.7-.288t.7.288l3.55 3.55l.35.35l.35.35q.3.3.288.7t-.313.7q-.3.275-.7.288T6 17.3zm10.6 2.125l8.5-8.5q.3-.3.7-.287t.7.312q.275.3.288.7t-.288.7l-9.2 9.2q-.3.3-.7.3t-.7-.3L7.4 13.05q-.275-.275-.275-.687t.275-.713q.3-.3.713-.3t.712.3zm4.225-7.05L13.05 11.65q-.275.275-.687.275t-.713-.275q-.3-.3-.3-.712t.3-.713L15.175 6.7q.275-.275.688-.275t.712.275q.3.3.3.712t-.3.713" />
                                                </svg>
                                            '
                                        ],
                                        'cancel' => [
                                            'label' => 'Dibatalkan',
                                            'icon' => '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                                                    <path fill="CURRENT_COLOR" d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm5 13l-2 2-3-3-3 3-2-2 3-3-3-3 2-2 3 3 3-3 2 2-3 3 3 3z"/>
                                                </svg>
                                            '
                                        ],
                                    ];

                                    $flow = array_keys($steps);
                                    $currentIndex = array_search($order->status, $flow);
                                @endphp

                                @foreach ($flow as $index => $key)
                                    @php
                                        $active = $index <= $currentIndex;
                                        $bg = $active ? 'bg-green-600' : 'bg-gray-300';
                                        $color = $active ? '#fff' : '#9ca3af'; // white or gray-400
                                        $icon = str_replace('CURRENT_COLOR', $color, $steps[$key]['icon']);
                                    @endphp

                                    <div class="flex flex-col items-center text-center">
                                        <div class="w-14 h-14 rounded-full flex items-center justify-center {!! $bg !!}">
                                            {!! $icon !!}
                                        </div>
                                        <p class="mt-2 text-sm {{ $active ? 'text-green-700 font-semibold' : 'text-gray-500' }}">
                                            {{ $steps[$key]['label'] }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- ================= PRODUK PESANAN ================= -->
                            <h3 class="font-bold text-lg mb-3">Produk Pesanan</h3>

                            @foreach ($order->orderItems as $item)
                            <div class="flex items-center justify-between border rounded-lg p-4 mb-3">

                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/60' }}"
                                        class="w-16 h-16 rounded-md border object-cover">

                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">Jumlah: {{ $item->quantity }}</p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="font-bold text-gray-800">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        @Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>
                            @endforeach

                            <!-- ================= ALAMAT & METODE BAYAR ================= -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Alamat Pengiriman</h4>
                                    <div class="p-3 bg-gray-100 rounded-lg text-gray-700">
                                        {{ $order->shipping_address ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-2">Metode Pembayaran</h4>
                                    <div class="p-3 bg-gray-100 rounded-lg text-gray-700">
                                        {{ strtoupper($order->payment_method) }}
                                    </div>
                                </div>

                            </div>

                            <!-- ================= TOTAL PEMBAYARAN ================= -->
                            <div class="mt-8 border-t pt-4 flex justify-between">
                                <p class="font-bold text-lg">Total Pembayaran</p>
                                <p class="font-bold text-lg">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- ================= TOMBOL BATAL + DOWNLOAD ================= -->
                            <div class="mt-6 flex gap-3">

                                @if($order->status === 'pending')
                                    <!-- Tombol Batalkan -->
                                    <form action="{{ route('store.profile.order.cancel', $order->id) }}" method="POST" class="w-1/2">
                                        @csrf
                                        <button type="submit"
                                                class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                @endif

                                <!-- Tombol Download -->
                                <a href="{{ route('store.profile.invoice.download', $order->id) }}"
                                class="w-1/2 bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 text-center flex items-center justify-center">
                                    Download Invoice
                                </a>

                            </div>
                        </div>
                    </div>


                    <!-- ================== MODAL CANCEL ================== -->
                    <div x-show="activeCancel === {{ $order->id }}"
                         x-transition
                         class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">

                            <button @click="activeCancel = null" class="absolute right-4 top-4 text-gray-500 hover:text-black">✕</button>

                            <h2 class="text-xl font-bold mb-4">Batalkan Pesanan?</h2>

                            <p class="text-gray-700 mb-6">
                                Apakah Anda yakin ingin membatalkan pesanan <strong>{{ $order->order_number }}</strong>?
                            </p>

                            @if(!in_array($order->status, ['dikirim', 'selesai', 'cancel']))
                                <!-- Tombol Batalkan -->
                                <form action="{{ route('store.profile.order.cancel', $order->id) }}" method="POST" class="w-1/2">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                                        Ya, Batalkan Pesanan
                                    </button>
                                </form>
                            @endif
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
