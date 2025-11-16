@extends('layouts.store')

@section('title', 'Profil Saya')

@section('content')
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">

        {{-- SIDEBAR --}}
        <aside class="md:w-1/4 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-6">
                
                {{-- Foto Profil --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 rounded-full overflow-hidden mb-3">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-green-500 text-white flex items-center justify-center text-3xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $user->username }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>

                    {{-- Form Upload Foto Profil --}}
                    <form action="{{ route('store.profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <label class="cursor-pointer text-green-600 font-medium hover:underline">
                            Ubah Foto Profil
                            <input type="file" name="profile_photo" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </label>
                        @error('profile_photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
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
                            <a href="{{ route('store.profile.orders') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-box-seam text-lg"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('store.profile.address') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="bi bi-geo-alt text-lg"></i>
                                <span>Alamat Pengiriman</span>
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

        {{-- MAIN CONTENT --}}
        <main class="md:w-3/4">
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

                {{-- Header Profil --}}
                <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
                    <h1 class="text-3xl font-bold text-gray-800">Profil Saya</h1>
                    <div class="flex gap-2">
                        <button 
                            id="openEditModal" 
                            class="bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                            Edit Profil
                        </button>
                    </div>
                </div>

                {{-- Informasi User --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-gray-800">
                            {{ $user->username }}
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

                {{-- Statistik --}}
                <div class="flex flex-col md:flex-row justify-around items-center text-center gap-6">
                    <div>
                        <p class="text-3xl font-bold text-green-600">{{ $totalOrders }}</p>
                        <p class="text-sm text-gray-500 mt-1">Total Pesanan</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">{{ $completedOrders }}</p>
                        <p class="text-sm text-gray-500 mt-1">Pesanan Selesai</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-yellow-500">{{ $processingOrders }}</p>
                        <p class="text-sm text-gray-500 mt-1">Dalam Proses</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- MODAL EDIT PROFIL --}}
    <div id="editProfileModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0"
             id="modalContent">
            <div class="p-6 md:p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Profil</h2>
                    <button id="closeEditModal" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition duration-200 text-2xl leading-none">&times;</button>
                </div>

                <form action="{{ route('store.profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Telepon</label>
                        <input type="text" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition duration-200">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Jenis Kelamin</label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="male" {{ old('gender', $user->gender) === 'male' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                <span class="text-gray-700">Laki-laki</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="female" {{ old('gender', $user->gender) === 'female' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                <span class="text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div class="md:col-span-2 flex justify-end mt-6 gap-3">
                        <button type="button" id="cancelEdit" class="border border-gray-300 px-6 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">Batal</button>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 font-medium">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editProfileModal');
    const modalContent = document.getElementById('modalContent');
    const openBtn = document.getElementById('openEditModal');
    const closeBtn = document.getElementById('closeEditModal');
    const cancelBtn = document.getElementById('cancelEdit');

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95','opacity-0');
            modalContent.classList.add('scale-100','opacity-100');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.remove('scale-100','opacity-100');
        modalContent.classList.add('scale-95','opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function(e){
        if(e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });
});
</script>
@endsection
