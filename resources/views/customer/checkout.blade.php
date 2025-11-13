@extends('layouts.store')

@section('title', 'Checkout')

@section('content')
<div class="bg-gradient-to-br from-slate-50 to-emerald-50 min-h-screen font-sans">
    
    <div class="container mx-auto max-w-7xl py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Selesaikan Pesanan</h1>
            <p class="text-slate-600 max-w-2xl mx-auto">
                Lengkapi informasi pengiriman sebelum melanjutkan ke pembayaran
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="container mx-auto px-4 py-8">
            <form action="{{ route('store.checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                    <!-- 🧭 Kolom Alamat -->
                    <div class="lg:col-span-2">
                        <div class="w-full space-y-5"> 
                            <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-3 sm:p-4 text-[12.5px]" 
                                x-data="{ selectedOption: 'saved', selectedAddress: 1 }">
                                
                                <div class="flex items-center gap-1.5 mb-3">
                                    <div class="w-5 h-5 bg-emerald-100 rounded flex items-center justify-center">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <h2 class="text-[13.5px] font-bold text-slate-800">Alamat Pengiriman</h2>
                                </div>
                                
                                <!-- Pilihan: alamat tersimpan / baru -->
                                <div class="space-y-2 mb-3">
                                    <label class="flex items-start gap-2 p-2 rounded-md cursor-pointer transition-all duration-200"
                                        :class="selectedOption === 'saved' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 hover:border-slate-300'">
                                        <input type="radio" name="address_option" value="saved" x-model="selectedOption" 
                                            class="mt-0.5 h-3.5 w-3.5 text-emerald-600 focus:ring-emerald-500">
                                        <div>
                                            <span class="font-semibold text-[12.5px]"
                                                :class="selectedOption === 'saved' ? 'text-emerald-700' : 'text-slate-700'">
                                                Gunakan Alamat Tersimpan
                                            </span>
                                            <p class="text-[11px] mt-0.5"
                                                :class="selectedOption === 'saved' ? 'text-emerald-600' : 'text-slate-600'">
                                                Pilih dari alamat yang sudah tersimpan
                                            </p>
                                        </div>
                                    </label>

                                    <label class="flex items-start gap-2 p-2 rounded-md cursor-pointer transition-all duration-200"
                                        :class="selectedOption === 'new' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 hover:border-slate-300'">
                                        <input type="radio" name="address_option" value="new" x-model="selectedOption" 
                                            class="mt-0.5 h-3.5 w-3.5 text-emerald-600 focus:ring-emerald-500">
                                        <div>
                                            <span class="font-semibold text-[12.5px]"
                                                :class="selectedOption === 'new' ? 'text-emerald-700' : 'text-slate-700'">
                                                Tambahkan Alamat Baru
                                            </span>
                                            <p class="text-[11px] mt-0.5"
                                                :class="selectedOption === 'new' ? 'text-emerald-600' : 'text-slate-600'">
                                                Tambah alamat pengiriman baru
                                            </p>
                                        </div>
                                    </label>
                                </div>

                                <!-- Jika pilih alamat tersimpan -->
                                <div class="space-y-2 pt-3 border-t border-slate-100" 
                                    x-show="selectedOption === 'saved'" 
                                    x-transition>
                                    <div @click="selectedAddress = 1"
                                        :class="selectedAddress === 1 ? 'border-2 border-emerald-500 bg-green-50' : 'border border-slate-200 hover:border-slate-300 bg-gray-50'"
                                        class="rounded-md p-2.5 relative group transition-all duration-200 cursor-pointer">
                                        
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h3 class="font-semibold text-slate-800 text-[12.5px]">Sarah Johnson</h3>
                                                <div class="space-y-0.5 text-[11px] text-slate-600"> 
                                                    <p>+62 812-3456-7890</p>
                                                    <p>Jl. Sudirman No. 123, Jakarta Pusat</p>
                                                    <p>Jakarta 10220</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jika pilih alamat baru -->
                                <div class="pt-3 border-t border-slate-100" 
                                    x-show="selectedOption === 'new'" 
                                    x-transition>
                                    <div class="space-y-3">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div>
                                                <label for="receiver_name" class="block text-[12px] font-medium text-slate-700 mb-1">Nama Penerima</label>
                                                <input type="text" id="receiver_name" name="receiver_name" placeholder="Masukkan nama penerima"
                                                    class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm" required>
                                            </div>
                                            <div>
                                                <label for="phone_number" class="block text-[12px] font-medium text-slate-700 mb-1">Nomor Telepon</label>
                                                <input type="text" id="phone_number" name="phone_number" placeholder="+62 812-3456-7890"
                                                    class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="full_address" class="block text-[12px] font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                                            <textarea id="full_address" name="full_address" rows="3" placeholder="Jl. Sudirman No. 123, RT/RW 01/02"
                                                    class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required></textarea>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div>
                                                <label for="city" class="block text-[12px] font-medium text-slate-700 mb-1">Kota / Kabupaten</label>
                                                <input type="text" id="city" name="city" placeholder="Jakarta"
                                                    class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                            </div>
                                            <div>
                                                <label for="postal_code" class="block text-[12px] font-medium text-slate-700 mb-1">Kode Pos</label>
                                                <input type="text" id="postal_code" name="postal_code" placeholder="10220"
                                                    class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="notes" class="block text-[12px] font-medium text-slate-700 mb-1">Catatan (opsional)</label>
                                            <input type="text" id="notes" name="notes" placeholder="Catatan untuk kurir (opsional)"
                                                class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                    </div>
                                </div>

                            </div> 
                        </div>
                    </div> 

                    <!-- 📦 Ringkasan Pesanan -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl border border-slate-100 p-4 sticky top-6 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-7 h-7 bg-slate-100 rounded flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-800">Ringkasan Pesanan</h2>
                            </div>

                            @include('layouts.partials.checkout-summary', [
                                'checkoutItems' => $checkoutItems,
                                'subtotal' => $subtotal,
                                'shippingCost' => $shippingCost,
                                'discount' => $discount,
                                'total' => $total,
                            ])

                            <button type="submit" class="w-full mt-5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-lg shadow-sm transition duration-200">
                                Lanjut ke Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
