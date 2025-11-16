<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Hygeia Logo" class="h-10 w-10 object-contain">
            <h1 class="text-2xl logo-font text-teal-600">Hygeia</h1>
        </div>
        <nav class="hidden md:flex space-x-8 text-green-700 font-medium">
            <a href="{{ url('/Hygeia') }}" class="hover:text-blue-700">Beranda</a>
            <a href="{{ url('/Hygeia/produk') }}" class="hover:text-blue-700">Produk</a>
            <a href="#tentang" class="hover:text-blue-700">Tentang Kami</a>
            <a href="#kontak" class="hover:text-blue-700">Kontak</a>
        </nav>
        <div class="flex items-center gap-x-3">
            <a href="{{ route('store.profile.index') }}" class="inline-block">
                <button 
                    type="button"
                    class="flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full shadow-md transition duration-200"
                    title="Profil Saya"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none">
                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2" />
                            <path d="M4.271 18.346S6.5 15.5 12 15.5s7.73 2.846 7.73 2.846M12 12a3 3 0 1 0 0-6a3 3 0 0 0 0 6" />
                        </g>
                    </svg>
                </button>
            </a>


            <a href="{{ route('customer.cart') }}">
                <button type="button" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </button>
            </a>

        </div>
    </div>
</header>