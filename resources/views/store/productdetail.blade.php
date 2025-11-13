@extends('layouts.store')

@section('title', $product->name ?? 'Detail Produk')

@section('content')
    <!-- Hero Section -->
    <section class="bg-transparent py-6 px-10 border-b border-gray-200">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('store.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#5e8e94] transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('store.product') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#5e8e94] transition duration-200 md:ml-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-[#5e8e94] md:ml-2">{{ $product->name ?? 'Product Detail' }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </section>

    <!-- Produk -->
    <secttion class="bg-white font-sans">
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
                    
                    <!-- Label -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2.5 py-0.5 rounded-full">
                            {{ strtoupper($product->category->name ?? 'Tanpa Kategori') }}
                        </span>

                        @if ($product->is_best_seller ?? false)
                            <span class="text-xs font-medium text-yellow-800 bg-yellow-300 px-2.5 py-0.5 rounded-full">
                                Best Seller
                            </span>
                        @endif
                    </div>

                    <!-- Nama Produk -->
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                    <!-- Rating (opsional jika ada relasi review) -->
                    @if (isset($averageRating))
                        <div class="flex items-center gap-2">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $averageRating ? 'fill-current' : 'fill-none' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-500">({{ $reviewCount ?? 0 }} reviews)</span>
                        </div>
                    @endif

                    <!-- Harga -->
                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold text-red-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @if ($product->discount_price)
                            <span class="text-xl line-through text-red-500">
                                Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-gray-600 text-sm leading-relaxed border-b pb-8 border-gray-300/20">{{ $product->description }}</p>

                    <div class="pt-4 flex justify-between items-center">

                    <!-- Input Jumlah Produk -->
                    <div>
                        <label for="quantity" class="text-sm font-medium text-gray-700 mr-2">Jumlah:</label>
                            <div class="inline-flex items-center border border-gray-300 rounded overflow-hidden">
                                <!-- Tombol Kurang -->
                                <button 
                                    type="button"
                                    class="px-3 py-1 text-lg text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                    onclick="updateQuantity(-1)"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    &minus;
                                </button>

                                <!-- Input Angka -->
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    id="quantity" 
                                    value="1" 
                                    min="1"
                                    max="{{ $product->stock > 0 ? $product->stock : 1 }}"
                                    class="w-14 text-center border-x border-gray-300 focus:outline-none focus:ring-1 focus:ring-green-500 [appearance:textfield]"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}
                                >

                                <!-- Tombol Tambah -->
                                <button 
                                    type="button"
                                    class="px-3 py-1 text-lg text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                    onclick="updateQuantity(1)"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    &plus;
                                </button>
                            </div>
                        </div>

                        <!-- Informasi Stok -->
                        <div>
                            <span class="text-sm font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? 'Tersedia ' . $product->stock : 'Stok Habis' }}
                            </span>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">

                        <form action="{{ route('store.cart.add') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">

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


                        <!-- Beli Sekarang -->
                        <button class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md">
                            Beli Sekarang
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11.383 2.978A1 1 0 0112 3v5h5a1 1 0 01.618.904l-2.852 8.555a1 1 0 01-.94.741H6.175a1 1 0 01-.97-.803L3.001 4.19A1 1 0 014 3h5.117a1 1 0 01.883.519l1.383-2.538a1 1 0 011.001-.537zM8 4H4.883l2.003 9h7.428l2.28-6.84H8V4z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Wishlist -->
                    <div class="text-center pt-2 border border-gray-300 rounded-lg py-3">
                        <button class="text-sm text-gray-600 hover:text-gray-900 font-medium flex items-center justify-center gap-1.5 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                            </svg>
                            <span>Tambahkan ke Wishlist</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </secttion>

    <!-- Review -->
@endsection

<script>
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        let current = parseInt(input.value);
        const min = parseInt(input.min);
        const max = parseInt(input.max);

        const newValue = current + change;

        if (newValue >= min && newValue <= max) {
            input.value = newValue;
        }
    }
</script>