@extends('layouts.store')

@section('title', 'Alamat Saya')

@section('content')
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">

        <!-- Sidebar -->
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

                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('store.profile.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900">
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
                            <a href="{{ route('store.profile.address') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-50 text-green-600 font-semibold">
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

        <!-- Main Content -->
        <main class="md:w-3/4">
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <h2 class="text-2xl font-semibold mb-6">Alamat Saya</h2>

                {{-- Tombol Tambah Alamat (Modal Trigger) --}}
                <div class="mb-4">
                    <button id="openModal" class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                        Tambah Alamat Baru
                    </button>
                </div>

                {{-- Daftar Alamat --}}
                @if($addresses->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($addresses as $address)
                            <div class="bg-white shadow rounded-lg p-4 relative">
                                <h3 class="text-lg font-semibold mb-2">{{ $address->receiver_name }}</h3>
                                <p class="text-gray-600 text-sm mb-1">Telepon: {{ $address->phone_number }}</p>
                                <p class="text-gray-600 text-sm mb-1">{{ $address->full_address }}, {{ $address->city }}, {{ $address->postal_code }}</p>
                                @if($address->notes)
                                    <p class="text-gray-500 text-sm italic">Catatan: {{ $address->notes }}</p>
                                @endif

                                <div class="absolute top-2 right-2 flex space-x-2">
                                    <a href="{{ route('store.profile.address.edit', $address->id) }}" 
                                       class="px-2 py-1 bg-blue-500 text-white text-xs rounded-md hover:bg-blue-600 transition">
                                       Edit
                                    </a>
                                    <button type="button" 
                                            class="px-2 py-1 bg-red-500 text-white text-xs rounded-md hover:bg-red-600 transition"
                                            onclick="openDeleteModal({{ $address->id }})">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            {{-- Modal Hapus untuk setiap alamat --}}
                            <div id="deleteModal-{{ $address->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
                                    <p class="mb-4">Apakah Anda yakin ingin menghapus alamat ini?</p>

                                    <form id="deleteForm-{{ $address->id }}" action="{{ route('store.profile.address.destroy', $address->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="closeDeleteModal({{ $address->id }})" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Batal</button>
                                            <button type="submit" class="px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                        </div>
                                    </form>

                                    <button onclick="closeDeleteModal({{ $address->id }})" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Anda belum menambahkan alamat.</p>
                @endif

            </div>
        </main>

    </div>
</div>

{{-- Modal Tambah Alamat--}}
<div id="addressModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <h3 class="text-xl font-semibold mb-4">Tambah Alamat Baru</h3>
        <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>

        <form action="{{ route('store.profile.address.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="receiver_name" class="block text-[12px] font-medium text-slate-700 mb-1">Nama Penerima</label>
                    <input type="text" id="receiver_name" name="receiver_name" placeholder="Masukkan nama penerima"
                        class="block w-full text-[12.5px] rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
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

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" id="cancelModal" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Script --}}
<script>
    const openModalBtn = document.getElementById('openModal');
    const modal = document.getElementById('addressModal');
    const closeModalBtn = document.getElementById('closeModal');
    const cancelModalBtn = document.getElementById('cancelModal');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    cancelModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    window.addEventListener('click', (e) => {
        if(e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    function openDeleteModal(id) {
        const modal = document.getElementById(`deleteModal-${id}`);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal(id) {
        const modal = document.getElementById(`deleteModal-${id}`);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Tutup modal jika klik di luar
    window.addEventListener('click', function(e) {
        document.querySelectorAll('[id^="deleteModal-"]').forEach(modal => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>
@endsection
