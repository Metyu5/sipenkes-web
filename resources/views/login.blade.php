<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPENKES</title>
    <link rel="icon" type="image/png" href="{{ asset('puskesmas logo.png') }}">
    @vite('resources/css/app.css')
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="relative flex items-center justify-center min-h-screen font-poppins bg-cover bg-center bg-no-repeat"
      style="background-image: url('{{ asset('images/latar.jpg') }}');">
    <div class="absolute inset-0 bg-blue-200/50 backdrop-blur-md"></div>
    <div class="relative w-full max-w-md p-8 space-y-6 bg-white/80 backdrop-blur-lg rounded-xl shadow-lg">
        <div class="w-full space-y-2">
            <div class="flex items-center justify-between">
                <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo Puskesmas" class="w-16 h-16">
                <div class="flex flex-col items-left flex-1 ml-5">
                    <h2 class="text-3xl font-bold text-green-700">SIPENKES</h2>
                    <p class="text-gray-500 font-regular">Log In</p>
                </div>
            </div>
            <hr class="mt-4 border-gray-300">
        </div>
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('proses.login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan email"
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-400" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password"
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-400" />
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Login Sebagai</label>
                <select id="role" name="role" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 focus:border-blue-400">
                    <option value="administrasi">Administrasi</option>
                    <option value="apoteker">Apoteker</option>
                    <option value="dokter">Dokter</option>
                </select>
            </div>
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-green-600 transition">
                Login
            </button>
        </form>
        <div class="text-center text-gray-600 text-sm space-y-2">
            <p class="font-semibold text-gray-700">Belum Punya Akun? Daftar sebagai:</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ url('apoteker') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                    Apoteker
                </a>
                <a href="{{ url('administrasi') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                    Administrasi
                </a>
                <a href="{{ url('formdokter') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                   Dokter
                </a>
            </div>
        </div>
    </div>
</body>
</html>
