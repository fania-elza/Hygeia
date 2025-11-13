<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Hygeia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        .logo-font {
            font-family: 'Pacifico', cursive;
            color: #009689;
        }
        input[type="text"][placeholder="hh/bb/tttt"]::-webkit-calendar-picker-indicator {
            display: none;
        }
    </style>
</head>
<body class="bg-green-50">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">

            {{-- Bagian kiri: branding --}}
            <div class="md:w-1/2 bg-green-100 flex flex-col justify-center items-center p-10 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Hygeia Logo" class="h-20 w-20 object-contain mb-3">
                <h2 class="text-3xl font-bold logo-font">Hygeia</h2>
                <p class="text-lg font-semibold text-gray-800 mt-3">Awali Perjalanan Menuju Sanctuary Kesehatan Anda</p>
                <p class="text-gray-600 mt-2">Di sini, harmoni tubuh dan pikiran menemukan wujudnya yang paling sempurna.</p>
            </div>

            {{-- Bagian kanan: form --}}
            <div class="md:w-1/2 p-10 md:max-h-screen md:overflow-y-auto">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Buat Akun Baru</h3>

                {{-- Tampilkan pesan error --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">

                        {{-- Username --}}
                        <div class="col-span-2">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Pengguna</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                placeholder="Username"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <input type="password" id="password" name="password" required
                                placeholder="Password"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Ulangi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="Retype Password"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Email --}}
                        <div class="col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                placeholder="Email"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Tanggal lahir --}}
                        <div>
                            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="text" id="dob" name="dob" value="{{ old('dob') }}" placeholder="hh/bb/tttt"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none"
                                onfocus="(this.type='date')" 
                                onblur="if(!this.value) {this.type='text'}">
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select id="gender" name="gender" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none text-gray-700">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Gender</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                            <style>
                                textarea {
                                    width: 100%;
                                    border: 1px solid #d1d5db;
                                    border-radius: 0.5rem;
                                    padding: 0.5rem 0.75rem;
                                    outline: none;
                                }
                                textarea:focus {
                                    border-color: transparent;
                                    box-shadow: 0 0 0 2px #10b981;
                                }
                            </style>
                        </div>

                        {{-- Kota --}}
                        <div class="col-span-2">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="Kota"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" placeholder="No. Telepon"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        {{-- Tombol --}}
                        <div class="col-span-2 grid grid-cols-2 gap-4 pt-4">
                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-lg transition duration-200 shadow-md">
                                Kirim
                            </button>
                            <button type="reset"
                                class="w-full bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 font-medium py-2.5 rounded-lg transition duration-200 shadow-md">
                                Bersihkan
                            </button>
                        </div>
                    </div>

                    <p class="text-center text-gray-600 text-sm pt-6">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-green-700 font-medium hover:underline">
                            Masuk ke Sanctuary Kesehatan Anda
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
