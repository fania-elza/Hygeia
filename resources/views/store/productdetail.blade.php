@extends('layouts.store')

@section('title', $product->name ?? 'Detail Produk')

@section('content')
    <!-- Hero Section -->
    <section class="bg-transparent py-6 px-10 border-b border-gray-200">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('store.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#5e8e94] transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Beranda
                    </a>
                </li>

                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                        </svg>
                        <a href="{{ route('store.product') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#5e8e94] md:ml-2">
                            Produk
                        </a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-[#5e8e94] md:ml-2">
                            {{ $product->name }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </section>

    <!-- Produk -->
    <section class="bg-white font-sans">
        <div class="container mx-auto max-w-6xl p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                <!-- Gambar Produk -->
                <div class="flex flex-col gap-4">
                    <div class="aspect-square w-full bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover object-center transition-transform duration-300 hover:scale-105"
                        >
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="flex flex-col space-y-4">

                    <!-- Label Kategori -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2.5 py-0.5 rounded-full">
                            {{ strtoupper($product->category->name ?? 'Tanpa Kategori') }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                    <!-- Harga -->
                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold text-red-500">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>

                        @if ($product->discount_price)
                            <span class="text-xl line-through text-red-500">
                                Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed border-b pb-8 border-gray-300/20">
                        {{ $product->description }}
                    </p>

                    <div class="pt-4 flex justify-between items-center">
                        <!-- Input Jumlah -->
                        <div>
                            <label for="quantity" class="text-sm font-medium text-gray-700 mr-2">Jumlah:</label>
                            <div class="inline-flex items-center border border-gray-300 rounded overflow-hidden">
                                
                                <button 
                                    type="button"
                                    class="px-3 py-1 text-lg text-gray-600 hover:bg-gray-100 transition"
                                    onclick="updateQuantity(-1)">
                                    &minus;
                                </button>

                                <input 
                                    type="number" 
                                    name="quantity" 
                                    id="quantity" 
                                    value="1" 
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="w-14 text-center border-x border-gray-300 focus:outline-none focus:ring-1 focus:ring-green-500 [appearance:textfield]">
                                
                                <button 
                                    type="button"
                                    class="px-3 py-1 text-lg text-gray-600 hover:bg-gray-100 transition"
                                    onclick="updateQuantity(1)">
                                    &plus;
                                </button>

                            </div>
                        </div>

                        <!-- Info Stok -->
                        <div>
                            <span class="text-sm font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? 'Tersedia ' . $product->stock : 'Stok Habis' }}
                            </span>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">

                        <!-- Jika belum login -->
                        @guest
                            <a href="{{ route('login') }}"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0
                                            a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Tambahkan ke Troli</span>
                            </a>

                            <a href="{{ route('login') }}"
                                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md">
                                Beli Sekarang
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M11.383 2.978A1 1 0 0112 3v5h5a1 1 0 01.618.904l-2.852 8.555a1 1 0 01-.94.741H6.175a1 1 0 01-.97-.803L3.001 4.19A1 1 0 014 3h5.117a1 1 0 01.883.519l1.383-2.538a1 1 0 011.001-.537z"/>
                                </svg>
                            </a>
                        @endguest

                        <!-- Jika sudah login -->
                        @auth
                            <form action="{{ route('customer.cart') }}" method="POST" class="w-full flex">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="addToCartQty" value="1">

                                <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0
                                                a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Tambahkan ke Troli</span>
                                </button>
                            </form>

                            <a href="{{ route('customer.checkout') }}?product_id={{ $product->id }}&qty=1"
                                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md">
                                Beli Sekarang
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M11.383 2.978A1 1 0 0112 3v5h5a1 1 0 01.618.904l-2.852 8.555a1 1 0 01-.94.741H6.175a1 1 0 01-.97-.803L3.001 4.19A1 1 0 014 3h5.117a1 1 0 01.883.519l1.383-2.538a1 1 0 011.001-.537z"/>
                                </svg>
                            </a>
                        @endauth

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

<script>
function updateQuantity(change) {
    const input = document.getElementById('quantity');
    let value = parseInt(input.value);
    const min = parseInt(input.min);
    const max = parseInt(input.max);

    const newVal = value + change;

    if (newVal >= min && newVal <= max) {
        input.value = newVal;

        // update hidden qty for cart
        const hidden = document.getElementById('addToCartQty');
        if (hidden) hidden.value = newVal;
    }
}
</script>
