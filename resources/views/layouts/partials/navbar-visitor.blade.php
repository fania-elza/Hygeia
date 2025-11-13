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
        <!-- Tombol Login -->
<a href="{{ route('login') }}"
   class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-full shadow-md transition duration-200 inline-block">
    Masuk
</a>
        
    </div>
</header>