{{-- resources/views/store/home.blade.php --}}
@extends('layouts.store')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-green-100/70 via-teal-100/60 to-blue-100/70 py-24 bg-cover bg-center"
        style="background-image: url('{{ asset('images/banner.png') }}');">

        <div class="absolute inset-0 bg-white/70 backdrop-blur-md"></div>

            <div class="relative max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="md:w-1/2 space-y-6 text-center md:text-left z-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-teal-800 leading-snug tracking-tight drop-shadow-sm">
                        Lahir dari <span class="text-green-700">Warisan Kesehatan Abadi</span>, <br>
                        <span class="text-amber-600">Dihadirkan Kembali untuk Masa Kini.</span>
                    </h1>
                    <p class="text-gray-700 text-lg max-w-lg mx-auto md:mx-0 leading-relaxed">
                        Dengan menjalin warisan kemurnian dan sains kontemporer, kami menumbuhkan kehidupan yang lebih bermakna.
                    </p>
                    <div class="flex justify-center md:justify-start gap-4 pt-2">
                        <a href="{{ url('/produk') }}" class="text-white font-bold px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2" 
                        style="background-color: #7EAA8E;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                            <defs>
                                <mask id="SVGLl4aCj4w">
                                    <g fill="none">
                                        <path fill="#555555" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 17h38l-4.2 26H9.2z" />
                                        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M35 17c0-6.627-4.925-12-11-12s-11 5.373-11 12" />
                                        <circle cx="17" cy="26" r="2" fill="#fff" />
                                        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M18 33s2 3 6 3s6-3 6-3" />
                                        <circle cx="31" cy="26" r="2" fill="#fff" />
                                    </g>
                                </mask>
                            </defs>
                            <path fill="#fff" d="M0 0h48v48H0z" mask="url(#SVGLl4aCj4w)" />
                        </svg> Belanja Sekarang
                        </a>

                        <a href="#tentang" class="border-2 border-[#7DA9B3] text-[#7DA9B3] px-8 py-3 rounded-full font-semibold shadow-sm 
                                hover:bg-[#7DA9B3] hover:text-white transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>

                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold text-green-800 mb-4">Estetika Kesehatan Nirmala</h2>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Di mana setiap ritual perawatan menjelma menjadi sebuah karya, 
                        untuk kesejahteraan yang terasa dan terpancar.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
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

                <div class="text-center mt-12">
                    <a href="{{ route('store.product') }}" 
                    class="inline-flex items-center gap-2 border border-green-700 text-green-700 
                            font-semibold px-6 py-3 rounded-lg transition-all duration-300 
                            hover:bg-green-700 hover:text-white">
                        Lihat Semua Produk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
    </section>

    <!-- Tentang Kami --> 
    <section id="tentang" class="py-8 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="w-full text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-serif font-light text-slate-800 tracking-wide">
                    Tentang <span class="text-4xl logo-font">Hygeia</span>
                </h2>
                <div class="w-24 h-0.5 mx-auto bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full mt-2"></div>
            </div>
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left Side - Main Content -->
                <div class="md:w-1/2 space-y-4 flex flex-col justify-center">
                    <p class="text-2xl text-slate-600 leading-relaxed">
                        <span class="logo-font">Hygeia</span> 
                        menghidupkan kembali legenda kesehatan dalam wujud modern—sebuah harmoni abadi antara 
                        <span class="text-slate-800 font-medium">kearifan alam</span> dan 
                        <span class="text-slate-800 font-medium">presisi sains</span>.
                    </p>

                    <p class="text-lg text-slate-500 italic leading-relaxed">
                        "Dari alam yang paling murni, untuk hidup yang paling sejahtera—setiap langkah bersama Hygeia adalah investasi dalam 
                        <span class="text-emerald-600 not-italic">seni hidup sehat</span>."
                    </p>
                </div>

                <!-- Right Side - Visi, Misi, Nilai -->
                <div class="md:w-1/2 space-y-3">
                    <div class="bg-[#EBF4EE] p-3 rounded-xl shadow-md">
                        <div class="flex items-center gap-4 mb-1">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-xl">🌿</span>
                            </div>
                            <h3 class="font-serif text-xl text-slate-800">Visi Kami</h3>
                        </div>
                        <p class="text-slate-600 text-lg leading-relaxed ml-14">
                            Menjadi penjaga warisan wellness yang mengubah kearifan klasik menjadi solusi kesehatan modern.
                        </p>
                    </div>

                    <div class="bg-[#EBF4EE] p-3 rounded-xl shadow-md">
                        <div class="flex items-center gap-4 mb-1">
                            <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-xl">🔬</span>
                            </div>
                            <h3 class="font-serif text-xl text-slate-800">Misi Kami</h3>
                        </div>
                        <p class="text-slate-600 text-lg leading-relaxed ml-14">
                            Menghadirkan produk terpilih dengan standar kemurnian tertinggi dan khasiat teruji.
                        </p>
                    </div>

                    <div class="bg-[#EBF4EE] p-3 rounded-xl shadow-md">
                        <div class="flex items-center gap-4 mb-1">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-xl">💫</span>
                            </div>
                            <h3 class="font-serif text-xl text-slate-800">Nilai Kami</h3>
                        </div>
                        <p class="text-slate-600 text-lg leading-relaxed ml-14">
                            Integritas, holistik, dan inovasi—setiap produk adalah komitmen pada kesejahteraan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
