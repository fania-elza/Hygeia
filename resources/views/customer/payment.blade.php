@extends('layouts.store')

@section('title', 'Payment')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4">

            <div class="text-center mb-8 relative">
                
                <div class="absolute left-0 top-1/2 -translate-y-1/2">
                    <a href="/Hygeia/checkout" 
                    class="flex items-center gap-1 text-sm text-slate-600 hover:text-slate-900 transition font-medium rounded-lg p-2 -m-2">
                        <svg class="w-4 h-4" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <h1 class="text-3xl font-bold text-slate-800">Selesaikan Pesanan</h1>
                <p class="text-slate-600 mt-1">Pilih metode pembayaran</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-5">

                    <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-lg font-bold text-slate-800">Alamat Pengiriman</h2>
                        </div>
                        
                        <div class="bg-emerald-50 border border-emerald-200 rounded-md p-3 text-sm text-emerald-800">
                            <p class="font-bold">Sarah Johnson</p>
                            <p class="text-emerald-700 mt-0.5">+62 812-3456-7890</p>
                            <p class="text-emerald-700 mt-0.5">Jl. Sudirman No. 123, Jakarta Pusat</p>
                            <p class="text-emerald-700">Jakarta 10220</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-slate-100 p-4 shadow-sm">
                        
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l.893-."892A.997.997 0 007.01 10H14.17l1.042-4.167A1 1 0 0014.22 4H4.23l-.38-1.52A1 1 0 002.85 2H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            <h2 class="text-lg font-bold text-slate-800">Detail Pesanan</h2>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-sm">
                                <img src="https://via.placeholder.com/64" alt="Vitamin C" class="w-12 h-12 rounded-md bg-gray-100">
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">Vitamin C 1000mg</p>
                                    <p class="text-xs text-slate-500">2 x Rp25.000</p>
                                </div>
                                <p class="font-medium text-slate-700">Rp50.000</p>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                <img src="https://via.placeholder.com/64" alt="Masker" class="w-12 h-12 rounded-md bg-gray-100">
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">Masker Medis 3 Ply</p>
                                    <p class="text-xs text-slate-500">1 x Rp15.000</p>
                                </div>
                                <p class="font-medium text-slate-700">Rp15.000</p>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                <img src="https://via.placeholder.com/64" alt="Hand Sanitizer" class="w-12 h-12 rounded-md bg-gray-100">
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">Hand Sanitizer 100ml</p>
                                    <p class="text-xs text-slate-500">1 x Rp20.000</p>
                                </div>
                                <p class="font-medium text-slate-700">Rp20.000</p>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-sm text-slate-600">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="font-medium text-slate-800">Rp85.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Ongkos Kirim</span>
                                <span class="font-medium text-slate-800">Rp10.000</span>
                            </div>
                            <div class="flex justify-between text-emerald-600">
                                <span>Diskon</span>
                                <span class="font-medium">-Rp5.000</span>
                            </div>
                            <div class="flex justify-between font-bold text-base text-slate-800 mt-2 pt-2 border-t border-slate-100">
                                <span>Total Pembayaran</span>
                                <span class="text-emerald-600">Rp90.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4 sticky top-6" 
                        x-data="{ selectedPayment: 'card' }">
                        
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-lg font-bold text-slate-800">Metode Pembayaran</h2>
                        </div>

                        <div class="space-y-3">
                            
                            <label @click="selectedPayment = 'card'"
                                :class="selectedPayment === 'card' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 bg-white hover:border-slate-300'"
                                class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border">
                                <input type="radio" name="payment_method" value="card" x-model="selectedPayment" class="mt-1 h-4 w-4 text-emerald-600 focus:ring-emerald-500">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">Kartu Kredit / Debit</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Bayar dengan Visa, Mastercard, atau JCB.</p>
                                </div>
                            </label>

                            <label @click="selectedPayment = 'cod'"
                                :class="selectedPayment === 'cod' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 bg-white hover:border-slate-300'"
                                class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border">
                                <input type="radio" name="payment_method" value="cod" x-model="selectedPayment" class="mt-1 h-4 w-4 text-emerald-600 focus:ring-emerald-500">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">CoD (Bayar di Tempat)</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Siapkan uang tunai saat kurir tiba.</p>
                                </div>
                            </label>

                            <label @click="selectedPayment = 'qris'"
                                :class="selectedPayment === 'qris' ? 'border-emerald-500 bg-emerald-50 border-2' : 'border-slate-200 bg-white hover:border-slate-300'"
                                class="flex items-start gap-3 p-3 rounded-md cursor-pointer transition-all duration-200 border">
                                <input type="radio" name="payment_method" value="qris" x-model="selectedPayment" class="mt-1 h-4 w-4 text-emerald-600 focus:ring-emerald-500">
                                <div>
                                    <span class="font-semibold text-sm text-slate-800">QRIS</span>
                                    <p class="text-xs text-slate-600 mt-0.5">Scan kode QR dengan GoPay, OVO, DANA, dll.</p>
                                </div>
                            </label>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-4">
                            
                            <div x-show="selectedPayment === 'card'" x-transition class="space-y-3">
                                <div>
                                    <label for="card_number" class="block text-sm font-medium text-slate-700 mb-1">Nomor Kartu</label>
                                    <input type="text" id="card_number" placeholder="0000 0000 0000 0000" class="block w-full text-sm rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label for="expiry_date" class="block text-sm font-medium text-slate-700 mb-1">Expiry (MM/YY)</label>
                                        <input type="text" id="expiry_date" placeholder="MM / YY" class="block w-full text-sm rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    </div>
                                    <div>
                                        <label for="cvv" class="block text-sm font-medium text-slate-700 mb-1">CVV</label>
                                        <input type="text" id="cvv" placeholder="123" class="block w-full text-sm rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    </div>
                                </div>
                            </div>

                            <div x-show="selectedPayment === 'qris'" x-transition class="text-center">
                                <p class="font-semibold text-slate-700 mb-2">Scan untuk Membayar</p>
                                <div class="flex justify-center">
                                    <div class="w-40 h-40 bg-gray-200 rounded-md flex items-center justify-center text-slate-500">
                                        [ Placeholder Kode QRIS ]
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 mt-2">Kode ini akan kedaluwarsa dalam 5 menit.</p>
                            </div>

                            <div x-show="selectedPayment === 'cod'" x-transition>
                                <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-md p-3 text-sm">
                                    <p class="font-semibold">Instruksi CoD (Bayar di Tempat)</p>
                                    <p class="mt-1">Pastikan Anda telah menyiapkan uang tunai pas sebesar <strong>Rp90.000</strong> untuk diserahkan kepada kurir saat pesanan Anda tiba.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="button" 
                                    class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold hover:bg-emerald-700 transition duration-200"
                                    x-text="selectedPayment === 'cod' ? 'Pesan Sekarang' : 'Bayar Sekarang (Rp90.000)'">
                                </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
