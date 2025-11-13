@extends('layouts.store')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-green-100/70 via-teal-100/60 to-blue-100/70 py-24 bg-cover bg-center"
        style="background-image: url('{{ asset('images/hproduk.jpg') }}');">

        <div class="absolute inset-0 bg-white/70 backdrop-blur-md"></div>

        <div class="relative max-w-7xl mx-auto px-5 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="md:w-1/2 space-y-6 text-center md:text-left z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-teal-800 leading-snug tracking-tight drop-shadow-sm">
                    Setiap Ritual, <span class="text-green-700">Sebuah Karya.</span>
                </h1>
                <p class="text-gray-700 text-lg max-w-lg mx-auto md:mx-0 leading-relaxed">
                    Temukan koleksi produk yang mengubah rutinitas perawatan Anda menjadi seni hidup sehat—di mana kesejahteraan tidak hanya dirasakan, tetapi juga bersinar dari dalam.
                </p>
                <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 pt-2 text-[#2B507B] font-medium text-xs">
                    <div class="flex items-center gap-2 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                            <path fill="#2B507B" fill-rule="evenodd" d="M35 8a1 1 0 1 0 0-2h-2a1 1 0 1 0 0 2v1.1c-.638.13-1.233.38-1.757.728L30.414 9A1 1 0 0 0 29 7.586l-.698.698l-.01.009l-.008.01l-.698.697A1 1 0 0 0 29 10.414l.828.829A5 5 0 0 0 29.1 13H28a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0h1.1c.13.638.38 1.233.728 1.757l-.828.829A1 1 0 1 0 27.586 19L29 20.414A1 1 0 0 0 30.414 19l.829-.828A5 5 0 0 0 33 18.9V20a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2v-1.1a5 5 0 0 0 1.757-.728l.829.828A1 1 0 0 0 39 20.414L40.414 19A1 1 0 0 0 39 17.586l-.828-.829A5 5 0 0 0 38.9 15H40a1 1 0 1 0 2 0v-2a1 1 0 1 0-2 0h-1.1a5 5 0 0 0-.728-1.757l.828-.829A1 1 0 1 0 40.414 9L39 7.586A1 1 0 1 0 37.586 9l-.829.828A5 5 0 0 0 35 9.1zm-1 3a3 3 0 1 0 0 6a3 3 0 0 0 0-6m-19.049.157l-1.5-2.598l1.732-1l1.5 2.598l1.732-1l1.085 1.88a3 3 0 0 1 3.147 1.45l4 6.928a3 3 0 0 1-1.098 4.098l-.866.5l1 1.732l-1.732 1l-1-1.732l-.866.5a3 3 0 0 1-4.098-1.098l-2.776-4.808A9.49 9.49 0 0 0 11 27.5c0 .854.112 1.68.323 2.465A9.46 9.46 0 0 1 15.5 29a9.49 9.49 0 0 1 7.709 3.947l13.634-7.872l1 1.732l-13.64 7.876a9.57 9.57 0 0 1 .68 5.317H39a1 1 0 1 1 0 2H6.634l-.216-.706A9.5 9.5 0 0 1 6 38.5a9.48 9.48 0 0 1 3.568-7.42A11.5 11.5 0 0 1 9 27.5a11.49 11.49 0 0 1 5.21-9.628l-.223-.385a3 3 0 0 1 .317-3.45l-1.085-1.88zm4.598 1.964l-3.464 2a1 1 0 0 0-.366 1.366l4 6.928a1 1 0 0 0 1.366.366l3.464-2a1 1 0 0 0 .366-1.366l-4-6.928a1 1 0 0 0-1.366-.366m1.916 20.833l-2.808 1.621l1 1.732l2.8-1.616A7.54 7.54 0 0 1 22.85 40H8.15a7.5 7.5 0 0 1 13.316-6.046" clip-rule="evenodd" stroke-width="1" stroke="#2B507B" />
                        </svg>
                        <span>Berbasis Penelitian</span>
                    </div>

                    <span class="hidden md:inline-block text-[#2B507B]/50 mt-5">|</span>

                    <div class="flex items-center gap-2 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#2B507B" d="M3 21V3h2v18zm4 0V9h2v12zm4 0v-6h2v6zm4 0V7h2v14zm4 0v-6h2v6z"/>
                        </svg>
                        <span>Efektivitas Optimal</span>
                    </div>

                    <span class="hidden md:inline-block text-[#2B507B]/50 mt-5">|</span>

                    <div class="flex items-center gap-2 mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#2B507B" d="M12 19.875q-.425 0-.825-.187t-.7-.538L2.825 10q-.225-.275-.337-.6t-.113-.675q0-.225.038-.462t.162-.438L4.45 4.1q.275-.5.738-.8T6.225 3h11.55q.575 0 1.038.3t.737.8l1.875 3.725q.125.2.163.437t.037.463q0 .35-.112.675t-.338.6l-7.65 9.15q-.3.35-.7.538t-.825.187M9.625 8h4.75l-1.5-3h-1.75zM11 16.675V10H5.45zm2 0L18.55 10H13zM16.6 8h2.65l-1.5-3H15.1zM4.75 8H7.4l1.5-3H6.25z" />
                        </svg>
                        <span>Layanan Eksklusif</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section class="bg-gray-50 py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-4 lg:gap-8">
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 bg-white shadow-md rounded-2xl p-6 border border-gray-100">
                        <h2 class="text-2xl font-semibold text-[#5e8e94] mb-6">Filter Produk</h2>
                        <!-- Filter Kategori -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Kategori</h3>
                            <ul class="space-y-3">
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="cat-all" name="category" type="radio"
                                            value="all"
                                            {{ request('category') == 'all' || !request('category') ? 'checked' : '' }}
                                            onchange="window.location='?category=all'"
                                            class="h-4 w-4 text-[#5e8e94] border-gray-300 rounded-full focus:ring-[#5e8e94]">
                                        <label for="cat-all" class="ml-3 text-sm text-gray-700">Semua Produk</label>
                                    </div>
                                    <span class="text-xs text-gray-500">({{ \App\Models\Product::count() }})</span>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input id="cat-{{ $category->id }}" name="category" type="radio"
                                                value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'checked' : '' }}
                                                onchange="window.location='?category={{ $category->id }}'"
                                                class="h-4 w-4 text-[#5e8e94] border-gray-300 rounded-full focus:ring-[#5e8e94]">
                                            <label for="cat-{{ $category->id }}" class="ml-3 text-sm text-gray-700">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                        <span class="text-xs text-gray-500">({{ $category->products()->count() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Tombol Clear -->
                        <div class="mt-10 border-t border-gray-200 pt-6">
                            <a href="{{ route('store.product') }}"
                            class="w-full block bg-gray-100 hover:bg-gray-200 text-gray-700 text-center font-medium py-2.5 px-4 rounded-lg transition duration-150">
                                Hapus Semua Filter
                            </a>
                        </div>
                    </div>
                </aside>


                <main class="lg:col-span-3 mt-12 lg:mt-0">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                        <div>
                            <h2 class="text-3xl font-serif font-light text-slate-800 tracking-wide">Semua Produk</h2>
                            <p class="text-sm text-slate-500 mt-2">
                                Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk
                            </p>
                        </div>

                        <div class="flex items-center gap-3 mt-4 sm:mt-0">
                            <form method="GET" action="{{ route('store.product') }}">
                                <select name="sort" onchange="this.form.submit()"
                                    class="rounded-lg border border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm py-2.5 px-3 text-slate-700 bg-white cursor-pointer transition duration-150">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Urutkan Berdasarkan</option>
                                    <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Produk Unggulan</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-5 gap-y-6">
                        @forelse ($products as $product)
                            <a href="{{ route('store.productdetail', ['name' => urlencode($product->name)]) }}"
                                 class="bg-white rounded-2xl shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                                
                                <!-- Gambar Produk -->
                                <div class="h-56 overflow-hidden">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover object-center rounded-t-2xl">
                                </div>

                                <!-- Konten -->
                                <div class="p-5 flex flex-col flex-grow">
                                    <p class="text-green-600 text-sm font-semibold mb-2 uppercase">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </p>


                                    <h3 class="text-lg font-bold text-gray-900 mb-2 min-h-[52px] leading-snug">
                                        {{ Str::limit($product->name, 50) }}
                                    </h3>

                                    <p class="text-gray-600 text-sm flex-grow mb-4 leading-relaxed min-h-[60px]">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="text-xl font-bold text-red-500">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="col-span-4 text-center text-gray-500">Belum ada produk yang tersedia.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <nav class="mt-12 flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
                            <!-- Tombol Previous -->
                            <div class="-mt-px flex w-0 flex-1">
                                @if ($products->onFirstPage())
                                    <span
                                        class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-400 cursor-not-allowed">
                                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}"
                                        class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-[#5e8e94] hover:border-[#5e8e94] hover:text-[#4c747a] transition">
                                        <svg class="mr-3 h-5 w-5 text-[#5e8e94]" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Sebelumnya
                                    </a>
                                @endif
                            </div>

                            <!-- Nomor Halaman -->
                            <div class="hidden md:-mt-px md:flex">
                                @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <span
                                            class="inline-flex items-center border-t-2 border-[#5e8e94] px-4 pt-4 text-sm font-medium text-[#5e8e94]">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-[#5e8e94]/50 hover:text-[#4c747a] transition">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Tombol Next -->
                            <div class="-mt-px flex w-0 flex-1 justify-end">
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}"
                                        class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-[#5e8e94] hover:border-[#5e8e94] hover:text-[#4c747a] transition">
                                        Selanjutnya
                                        <svg class="ml-3 h-5 w-5 text-[#5e8e94]" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-400 cursor-not-allowed">
                                        Selanjutnya
                                        <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </nav>
                    @endif

                </main>

            </div>
        </div>
    </section>
@endsection
