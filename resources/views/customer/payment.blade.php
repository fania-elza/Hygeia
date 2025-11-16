@extends('layouts.store')

@section('title', 'Payment')

@section('content')
<div class="bg-gradient-to-br from-slate-50 to-emerald-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-8 relative">
            <div class="absolute left-0 top-1/2 -translate-y-1/2">
                <a href="{{ route('customer.checkout') }}" 
                   class="flex items-center gap-1 text-sm text-slate-600 hover:text-slate-900 font-medium rounded-lg p-2 -m-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-800">Selesaikan Pesanan</h1>
            <p class="text-slate-600 mt-1">Pilih metode pembayaran</p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('store.order.store') }}" method="POST">
            @csrf

            {{-- Hidden data untuk dikirim ke order --}}
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            <input type="hidden" name="shipping_cost" value="{{ $shippingCost }}">
            <input type="hidden" name="discount" value="{{ $discount }}">
            <input type="hidden" name="total_amount" value="{{ $subtotal + $shippingCost - $discount }}">

            {{-- Shipping Info --}}
            <input type="hidden" name="receiver_name" value="{{ $shippingInfo['receiver_name'] }}">
            <input type="hidden" name="phone_number" value="{{ $shippingInfo['phone_number'] }}">
            <input type="hidden" name="full_address" value="{{ $shippingInfo['full_address'] }}">
            <input type="hidden" name="city" value="{{ $shippingInfo['city'] }}">
            <input type="hidden" name="postal_code" value="{{ $shippingInfo['postal_code'] }}">
            <input type="hidden" name="notes" value="{{ $shippingInfo['notes'] }}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Ringkasan Pesanan & Alamat --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Alamat --}}
                    <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4">
                        <h2 class="font-bold text-slate-800 mb-2">Alamat Pengiriman</h2>
                        <div class="bg-emerald-50 border border-emerald-200 rounded-md p-3 text-sm text-emerald-800">
                            <p class="font-bold">{{ $shippingInfo['receiver_name'] }}</p>
                            <p>{{ $shippingInfo['phone_number'] }}</p>
                            <p>{{ $shippingInfo['full_address'] }}, {{ $shippingInfo['city'] }} {{ $shippingInfo['postal_code'] }}</p>
                            <p class="italic text-slate-600">{{ $shippingInfo['notes'] ?? '' }}</p>
                        </div>
                    </div>

                    {{-- Produk --}}
                    <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4">
                        <h2 class="font-bold text-slate-800 mb-2">Detail Pesanan</h2>
                        <div class="space-y-3">
                            @foreach($checkoutItems as $item)
                                <div class="flex items-center gap-3 text-sm">
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/64' }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="w-12 h-12 rounded-md bg-gray-100">
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $item['name'] }}</p>
                                        <p class="text-xs text-slate-500">
                                            {{ $item['quantity'] }} x Rp{{ number_format($item['price'],0,',','.') }}
                                        </p>
                                    </div>
                                    <p class="font-medium text-slate-700">
                                        Rp{{ number_format($item['quantity'] * $item['price'],0,',','.') }}
                                    </p>
                                </div>

                                {{-- Hidden item untuk dikirim ke controller --}}
                                <input type="hidden" name="items[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                                <input type="hidden" name="items[{{ $item['id'] }}][name]" value="{{ $item['name'] }}">
                                <input type="hidden" name="items[{{ $item['id'] }}][quantity]" value="{{ $item['quantity'] }}">
                                <input type="hidden" name="items[{{ $item['id'] }}][price]" value="{{ $item['price'] }}">
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-sm text-slate-600">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="font-medium text-slate-800">Rp{{ number_format($subtotal,0,',','.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Ongkos Kirim</span>
                                <span class="font-medium text-slate-800">Rp{{ number_format($shippingCost,0,',','.') }}</span>
                            </div>
                            <div class="flex justify-between text-emerald-600">
                                <span>Diskon</span>
                                <span class="font-medium">-Rp{{ number_format($discount,0,',','.') }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-base text-slate-800 mt-2 pt-2 border-t border-slate-100">
                                <span>Total Pembayaran</span>
                                <span class="text-emerald-600">
                                    Rp{{ number_format($subtotal + $shippingCost - $discount,0,',','.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4 sticky top-6" 
                             x-data="{ method: 'Kartu Kredit' }">

                            <h2 class="font-bold text-slate-800 mb-3">Metode Pembayaran</h2>

                            {{-- Kartu Kredit --}}
                            <label class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border"
                                :class="method === 'Kartu Kredit' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 hover:border-slate-300'"
                                @click="method = 'Kartu Kredit'">
                                <input type="radio" name="payment_method" value="Kartu Kredit" x-model="method" class="mt-1 h-4 w-4">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">Kartu Kredit / Debit</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Visa, Mastercard, atau JCB.</p>
                                </div>
                            </label>

                            {{-- COD --}}
                            <label class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border"
                                :class="method === 'COD' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 hover:border-slate-300'"
                                @click="method = 'COD'">
                                <input type="radio" name="payment_method" value="COD" x-model="method" class="mt-1 h-4 w-4">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">COD (Bayar di Tempat)</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Bayar saat barang tiba.</p>
                                </div>
                            </label>

                            {{-- QRIS --}}
                            <label class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border"
                                :class="method === 'QRIS' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 hover:border-slate-300'"
                                @click="method = 'QRIS'">
                                <input type="radio" name="payment_method" value="QRIS" x-model="method" class="mt-1 h-4 w-4">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">QRIS</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Scan QR menggunakan e-wallet.</p>
                                </div>
                            </label>

                            {{-- Submit --}}
                            <button 
                                type="submit"
                                class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold mt-5 hover:bg-emerald-700 transition duration-200">
                                <span x-text="
                                    method === 'COD' 
                                    ? 'Pesan Sekarang' 
                                    : 'Bayar Sekarang (Rp{{ number_format($subtotal+$shippingCost-$discount,0,',','.') }})'
                                "></span>
                            </button>

                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>
@endsection
