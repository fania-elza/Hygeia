@extends('layouts.store')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- 🧭 Breadcrumb -->
    <section class="bg-white py-4 px-4 sm:px-10 border-b border-gray-200">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('store.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#5e8e94] transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-[#5e8e94] md:ml-2">Shopping Cart</span>
                    </div>
                </li>
            </ol>
        </nav>
    </section>

    <div class="container mx-auto max-w-7xl py-10 px-4 sm:px-10">

        <!-- ✅ Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- 🛒 List Item -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex justify-between items-baseline">
                    <h1 class="text-3xl font-bold text-gray-800">Keranjang Belanja</h1>
                    <span class="text-sm font-medium text-gray-500">{{ $totalItems }} item</span>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 space-y-8">
                    <div class="space-y-6">
                        <h2 class="flex items-center gap-2 text-lg font-semibold text-gray-700">
                            <span class="w-3 h-3 bg-green-500 rounded-full @if(count($cartItems) > 0) animate-pulse @endif"></span>
                            Item di Troli ({{ count($cartItems) }} jenis)
                        </h2>
                        
                        @forelse ($cartItems as $id => $item)
                            <div class="flex flex-col sm:flex-row gap-4 border-b border-gray-100 pb-6 sm:items-center">
                                
                                <div class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="selected_items[]" 
                                        value="{{ $id }}" 
                                        class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                        onchange="updateSummary()">
                                </div>

                                <img 
                                    src="{{ $item['image'] ? (filter_var($item['image'], FILTER_VALIDATE_URL) ? $item['image'] : asset('storage/' . $item['image'])) : asset('images/no-image.png') }}" 
                                    alt="{{ $item['name'] }}" 
                                    class="flex-shrink-0 w-full sm:w-28 h-28 rounded-lg object-cover bg-gray-100"
                                    onerror="this.src='{{ asset('images/no-image.png') }}'"
                                >
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item['category'] ?? 'Tanpa Kategori' }}</p>
                                    <div class="flex items-baseline gap-2 mt-1">
                                        <span class="font-bold text-lg text-teal-600">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </span>
                                        <span class="text-sm text-gray-500">× {{ $item['quantity'] }}</span>
                                        <span class="font-semibold text-gray-800">
                                            = Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <!-- Form untuk decrease quantity -->
                                    <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                        <button type="submit" 
                                            class="w-8 h-8 flex items-center justify-center text-lg text-gray-600 hover:bg-gray-100 rounded border border-gray-300 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                            @if($item['quantity'] <= 1) disabled @endif
                                            title="Kurangi">
                                            &minus;
                                        </button>
                                    </form>

                                    <span class="text-gray-800 font-medium w-8 text-center select-none">
                                        {{ $item['quantity'] }}
                                    </span>

                                    <!-- Form untuk increase quantity -->
                                    <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                        <button type="submit" 
                                            class="w-8 h-8 flex items-center justify-center text-lg text-gray-600 hover:bg-gray-100 rounded border border-gray-300 transition duration-200"
                                            title="Tambah">
                                            &plus;
                                        </button>
                                    </form>

                                    <!-- Form untuk hapus item -->
                                    <form action="{{ route('customer.cart.remove', $id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus \'{{ addslashes($item['name']) }}\' dari keranjang?')"
                                            class="text-red-500 hover:text-red-700 transition p-1 rounded hover:bg-red-50"
                                            title="Hapus dari keranjang">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-lg mb-4">Keranjang belanja Anda kosong.</p>
                                <a href="{{ route('store.product') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition duration-200">
                                    Mulai belanja sekarang &rarr;
                                </a>
                            </div>
                        @endforelse

                        <!-- Tombol Clear Cart -->
                        @if(count($cartItems) > 0)
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <form action="{{ route('customer.cart.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan seluruh keranjang belanja?')">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 transition duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"></path>
                                    </svg>
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 💳 Ringkasan Pesanan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-28">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-4">Ringkasan Pesanan</h2>

                    <form action="{{ route('customer.cart.checkoutSelected') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div id="selectedItemsContainer"></div> <!-- Hidden inputs disini -->

                        <div class="space-y-3 mt-6 border-b border-gray-200 pb-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ $totalItems }} item)</span>
                                <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span class="font-medium">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-gray-800 mt-4">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-6 space-y-3">
                            <button type="submit" id="checkoutButton"
                                class="w-full bg-green-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-md disabled:bg-gray-400 disabled:cursor-not-allowed"
                                title="Lanjut ke halaman checkout">
                                Beli Sekarang
                            </button>

                            <a href="{{ route('store.product') }}" 
                                class="w-full bg-white border border-yellow-500 text-yellow-600 hover:bg-yellow-50 font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10.707 3.293a1 1 0 010 1.414L7.414 9H17a1 1 0 110 2H7.414l3.293 3.293a1 1 0 01-1.414 1.414l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Lanjut Belanja
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk update ringkasan pesanan berdasarkan item yang dipilih
function updateSummary() {
    const checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
    const checkoutButton = document.getElementById('checkoutButton');
    const container = document.getElementById('selectedItemsContainer');

    // Kosongkan container hidden input
    container.innerHTML = '';

    if (checkboxes.length === 0) {
        checkoutButton.disabled = true;
        return;
    }

    // Buat hidden input untuk setiap item terpilih
    checkboxes.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_items[]';
        input.value = cb.value;
        container.appendChild(input);
    });

    checkoutButton.disabled = false;
}

// Saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    updateSummary();

    // Auto-check semua item
    const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
    if (checkboxes.length > 0) {
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        updateSummary();
    }
});
</script>
@endsection