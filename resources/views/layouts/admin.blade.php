<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hygeia Admin Portal</title>

    <!-- Font mirip logo -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        .logo-font {
            font-family: 'Pacifico', cursive;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans text-gray-800 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md min-h-screen relative">
        <!-- Header Logo -->
        <div class="p-5 flex items-center space-x-2 border-b border-gray-300">
            <img src="{{ asset('images/logo.png') }}" alt="Hygeia Logo" class="h-10 w-10 object-contain">
            <h1 class="text-2xl logo-font text-teal-600">Hygeia</h1>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            {{-- Products --}}
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.products.*') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>

            {{-- Categories --}}
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.categories.*') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-tags-fill"></i>
                <span>Categories</span>
            </a>

            {{-- Customers --}}
            <a href="{{ route('admin.customers') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.customers') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-people-fill"></i>
                <span>Customers</span>
            </a>

            {{-- Orders --}}
            <a href="{{ route('admin.orders') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.orders') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-cart-check-fill"></i>
                <span>Orders</span>
            </a>

            {{-- Reviews / Feedbacks --}}
            <a href="{{ route('admin.feedbacks') }}"
               class="flex items-center space-x-2 py-2 px-4 rounded-md 
               {{ request()->routeIs('admin.feedbacks') ? 'bg-teal-50 text-teal-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Reviews</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="absolute bottom-4 w-full px-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" 
                    class="w-full flex items-center justify-start space-x-2 text-red-600 font-medium hover:text-red-800">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow-sm p-5 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Welcome, Panacea</h2>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo admin.png') }}" alt="Admin Icon" class="h-10 w-10 object-contain rounded-full">
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 space-y-6">
            @yield('content')
        </main>
    </div>

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    @stack('scripts')

</body>
</html>
