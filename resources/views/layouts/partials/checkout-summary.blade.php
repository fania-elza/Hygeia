<div class="bg-white rounded-lg p-5 w-full max-w-md">

    <!-- Daftar Produk -->
    <div class="divide-y divide-gray-200 mb-4">
        @forelse ($checkoutItems as $item)
            <div class="py-4 flex justify-between items-center">
                <div class="flex items-center space-x-4 w-3/4">
                    <img src="{{ asset('storage/' . $item['image']) }}" 
                        alt="{{ $item['name'] }}" 
                        class="w-20 h-20 object-cover rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex flex-col">
                        <p class="font-semibold text-gray-900 text-base">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $item['quantity'] }} x Rp{{ number_format($item['price'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <p class="font-semibold text-gray-800 text-base w-1/4 text-right">
                    Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                </p>
            </div>
        @empty
            <div class="py-6 text-center text-gray-500 text-sm">
                Tidak ada produk yang dipilih untuk checkout.
            </div>
        @endforelse
    </div>

    @if (!empty($checkoutItems))
        <!-- Subtotal -->
        <div class="flex justify-between text-sm text-gray-700 mb-2">
            <span>Subtotal</span>
            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>

        <!-- Ongkos Kirim -->
        <div class="flex justify-between text-sm text-gray-700 mb-2">
            <span>Ongkos Kirim</span>
            <span>Rp{{ number_format($shippingCost, 0, ',', '.') }}</span>
        </div>

        <!-- Diskon -->
        <div class="flex justify-between text-sm text-gray-700 mb-2">
            <span>Diskon</span>
            <span>-Rp{{ number_format($discount, 0, ',', '.') }}</span>
        </div>

        <hr class="my-3">

        <!-- Total -->
        <div class="flex justify-between items-center text-lg font-semibold text-gray-900">
            <span>Total</span>
            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <!-- Tombol Checkout -->
        <div class="mt-5">
            <a href="{{ route('store.checkout.payment') }}"
                class="block w-full bg-green-600 text-white py-2 rounded-lg font-medium text-center hover:bg-green-700 transition">
                Lanjut ke Pembayaran
            </a>
        </div>
    @endif
</div>
