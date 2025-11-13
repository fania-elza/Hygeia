<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Hygeia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-green-700 mb-6">Login Admin</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" required 
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" required 
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <button type="submit" 
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Login
            </button>
        </form>
    </div>
</body>
</html>
