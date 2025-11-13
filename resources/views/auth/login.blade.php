{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Hygeia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .logo-font {
            font-family: 'Pacifico', cursive;
            color: #009689;
        }
    </style>
</head>
<body class="bg-green-50">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">

            <!-- Kiri (sambutan) -->
            <div class="md:w-1/2 bg-green-100 flex flex-col justify-center items-center p-10 text-center">
                <div class="flex flex-col items-center space-y-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Hygeia Logo" class="h-20 w-20 object-contain">
                    <h2 class="text-3xl font-bold logo-font">Hygeia</h2>
                    <p class="text-lg font-semibold text-gray-800">Selamat Datang di Sanctuary Kesehatan Anda</p>
                    <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan berbelanja dan menjaga kesehatan bersama Hygeia</p>
                </div>
            </div>

            <!-- Kanan (form login) -->
            <div class="md:w-1/2 p-10 md:max-h-screen md:overflow-y-auto">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Masuk ke Akun Anda</h3>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-green-500">
                            <i class="bi bi-envelope text-gray-400 mr-2"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="Masukkan email Anda"
                                class="w-full border-none focus:ring-0 text-gray-700 placeholder-gray-400">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                        <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-green-500">
                            <i class="bi bi-lock text-gray-400 mr-2"></i>
                            <input id="password" type="password" name="password" required
                                placeholder="Masukkan kata sandi"
                                class="w-full border-none focus:ring-0 text-gray-700 placeholder-gray-400">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol login -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-lg transition duration-200 shadow-md">
                        Masuk
                    </button>

                    <!-- Link registrasi -->
                    <p class="text-center text-gray-600 text-sm mt-4">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-green-700 font-medium hover:underline">
                            Ciptakan Sanctuary Anda
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
