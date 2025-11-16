{{-- resources/views/layouts/store.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hygeia - @yield('title', 'Toko Kesehatan Online')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font mirip logo -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        .logo-font {
            font-family: 'Pacifico', cursive;
            color: #009689; /* Warna teal */
        }
    </style>

    @stack('styles')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="bg-white font-sans text-gray-800">

    <!-- 🧭 Navbar -->
    @auth
        @include('layouts.partials.navbar-customer')
    @endauth

    @guest
        @include('layouts.partials.navbar-visitor')
    @endguest

    <!-- ✨ Konten Halaman -->
    <main class="bg-white">
        @yield('content')
    </main>

    <!-- 🦶 Footer -->
    <footer id="kontak" class="bg-green-700 text-white py-10 mt-16">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-3">Hygeia</h3>
                <p class="text-sm text-green-100">Solusi kesehatan modern untuk hidup lebih sehat dan bahagia.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-green-100">
                    <li><a href="{{ url('/Hygeia') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ url('/Hygeia/produk') }}" class="hover:text-white">Produk</a></li>
                    <li><a href="{{ route('store.home') }}#tentang-kami" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="{{ route('store.home') }}#kontak" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Kontak Kami</h4>
                <p>Email: hygeiafriend@gmail.com</p>
                <p>Telepon: (+62)87762730921</p>
                <p>Alamat: Surabaya, Indonesia</p>
            </div>
        </div>
        <div class="text-center text-green-200 text-sm mt-8">
            &copy; 2025 Hygeia. Semua Hak Dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
