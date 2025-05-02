<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Dokter</title>
    <link rel="icon" type="image/png" href="{{ asset('puskesmas logo.png') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen font-poppins">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl">
        <h2 class="text-2xl font-semibold text-green-600 mb-4 text-left">Form Data Dokter</h2>
        <form action="{{ route('dokter.register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1">Nama Depan</label>
                    <input type="text" name="nama_depan" placeholder="Masukkan nama depan" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Nama Belakang</label>
                    <input type="text" name="nama_belakang" placeholder="Masukkan nama belakang" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">NIP</label>
                <input type="text" name="NIP" placeholder="Masukkan NIP" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="Masukkan email" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>
            <div>
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full p-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Spesialis</label>
                <input type="text" name="spesialis" placeholder="Contoh: Dokter Umum, Spesialis Jantung" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" placeholder="Masukkan alamat lengkap" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required></textarea>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Jam Praktik</label>
                <input type="text" name="jam_praktik" placeholder="08:00 - 16:00" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Tanggal Mendaftar</label>
                <input type="date" name="tanggal_mendaftar" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Foto</label>
                <input type="file" name="foto" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
