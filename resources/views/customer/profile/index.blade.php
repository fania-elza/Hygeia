@extends('layouts.store')

@section('title', 'Profil Saya')

@section('content')
<div x-data="{ openEdit: false }" class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">

        {{-- ========== SIDEBAR ========== --}}
        <aside class="md:w-1/4 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6">
                
                {{-- Foto Profil Singkatan Nama --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-green-500 text-white flex items-center justify-center text-3xl font-bold mb-3">
                        {{-- Ini sudah benar, menggunakan $user->name --}}
                        {{ strtoupper(substr($user->name, 0, 2)) }} 
                    </div>
                    {{-- 
                      * PERBAIKAN 1: 
                      * Diubah dari $user->username menjadi $user->name 
                      * agar menampilkan nama lengkap, bukan username.
                    --}}
                    <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>

                {{-- Navigasi --}}
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('store.profile.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-50 text-green-600 font-semibold">
                                <i class="bi bi-person-fill text-lg"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-box-seam text-lg"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-geo-alt text-lg"></i>
                                <span>Alamat Pengiriman</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-bell text-lg"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-question-circle text-lg"></i>
                                <span>Bantuan & Dukungan</span>
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="my-6 border-gray-200">

                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                    <i class="bi bi-box-arrow-left text-lg"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- ========== MAIN CONTENT ========== --}}
        <main class="md:w-3/4">
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                {{-- Header Profil --}}
                <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
                    <h1 class="text-3xl font-bold text-gray-800">Profil Saya</h1>
                    <div class="flex gap-2">
                        <button 
                            @click="openEdit = true" 
                            class="bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                            Edit Profil
                        </button>
                        <a href="#" class="bg-white text-green-600 border border-green-600 px-5 py-2 rounded-lg font-medium hover:bg-green-50 transition duration-200">
                            Ubah Password
                        </a>
                    </div>
                </div>

                {{-- Foto Profil --}}
                <div class="flex flex-col items-center my-6 md:my-8">
                    <div class="w-24 h-24 rounded-full bg-green-500 text-white flex items-center justify-center text-4xl font-bold mb-4">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <a href="#" class="text-green-600 font-medium hover:underline">
                        Ubah Foto Profil
                    </a>
                </div>

                {{-- Informasi User --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                             {{-- 
                              * PERBAIKAN 2: 
                              * Diubah dari $user->username menjadi $user->name 
                              * agar menampilkan nama lengkap yang sesuai.
                            --}}
                            {{ $user->name }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Telepon</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                            {{ $user->contact_number ?? '-' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                            {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d F Y') : '-' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                            {{ $user->gender ?? '-' }}
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-200">

                {{-- Statistik Akun (Dummy) --}}
                <div class="flex flex-col md:flex-row justify-around items-center text-center gap-6">
                    <div>
                        <p class="text-3xl font-bold text-green-600">12</p>
                        <p class="text-sm text-gray-500 mt-1">Total Pesanan</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">8</p>
                        <p class="text-sm text-gray-500 mt-1">Pesanan Selesai</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-yellow-500">2</p>
                        <p class="text-sm text-gray-500 mt-1">Dalam Proses</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <div 
        x-show="openEdit"
        x-cloak
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        {{-- 
          * PERBAIKAN 4: 
          * Backdrop diubah dari bg-black/5 menjadi bg-black/50 (atau bg-gray-900/50)
        --}}
        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900/50 p-4">

        <div 
            @click.away="openEdit = false"
            x-show="openEdit"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 md:p-8">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Edit Profil</h2>
                {{-- PERBAIKAN 6: Tombol close di-style agar lebih rapi --}}
                <button @click="openEdit = false" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:text-gray-800 hover:bg-gray-100 text-2xl leading-none">&times;</button>
            </div>

            <form action="{{ route('store.profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                    {{-- 
                      * PERBAIKAN 3: 
                      * Value diubah dari $user->username menjadi $user->name 
                      * agar data yang di-edit adalah data yang benar.
                    --}}
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Telepon</label>
                    <input type="text" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                    <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Jenis Kelamin</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="gender" value="Laki-laki" 
                                class="text-green-600 focus:ring-green-500"
                                {{ old('gender', $user->gender) === 'Laki-laki' ? 'checked' : '' }}>
                            Laki-laki
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="gender" value="Perempuan" 
                                class="text-green-600 focus:ring-green-500"
                                {{ old('gender', $user->gender) === 'Perempuan' ? 'checked' : '' }}>
                            Perempuan
                        </label>
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-end mt-6 gap-3">
                    <button type="button" 
                            @click="openEdit = false"
                            class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection