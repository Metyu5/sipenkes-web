<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPENKES</title>
  <link rel="icon" type="image/png" href="{{ asset('puskesmas logo.png') }}">

  @vite('resources/css/app.css')
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>

<body class="font-[Poppins]">
  <section class="bg-gradient-to-br from-blue-50 to-white min-h-screen flex items-center justify-center">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12 w-full">
      <main class="flex items-center justify-center px-6 py-6 sm:px-8 lg:col-span-12">
        <div class="max-w-xl lg:max-w-2xl mx-auto p-6 border border-gray-300 rounded-lg shadow-xl" data-aos="fade-in" data-aos-duration="500">
          <a class="block text-blue-600 mx-auto" href="#">
            <span class="sr-only">Home</span>
            <img src="{{ asset('puskesmas logo.png') }}" alt="Logo Puskesmas" class="h-12 w-12 sm:h-14 sm:w-14">
          </a>
          <h1 class="mt-4 text-xl font-bold text-gray-900 sm:text-2xl md:text-3xl">
            Daftar Akun Apoteker 💊
          </h1>
          <p class="mt-2 leading-relaxed text-gray-500 text-sm">
            Silakan isi formulir di bawah ini untuk membuat akun sebagai apoteker di Puskesmas.
          </p>

          <!-- Notifikasi Sukses -->
          @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
              {{ session('success') }}
            </div>
          @endif

          <!-- Notifikasi Error -->
          @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
              <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('apoteker.register') }}" method="POST" enctype="multipart/form-data" class="mt-6 grid grid-cols-6 gap-4">
            @csrf
            <!-- Nama Depan -->
            <div class="col-span-6 sm:col-span-3">
              <label for="FirstName" class="block text-xs font-medium text-gray-700">Nama Depan</label>
              <input type="text" id="FirstName" name="nama_depan" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('nama_depan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Nama Belakang -->
            <div class="col-span-6 sm:col-span-3">
              <label for="LastName" class="block text-xs font-medium text-gray-700">Nama Belakang</label>
              <input type="text" id="LastName" name="nama_belakang" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('nama_belakang')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- NIP -->
            <div class="col-span-6">
              <label for="NIP" class="block text-xs font-medium text-gray-700">NIP (Nomor Induk Pegawai)</label>
              <input type="text" id="NIP" name="NIP" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('NIP')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email -->
            <div class="col-span-6">
              <label for="Email" class="block text-xs font-medium text-gray-700">Email</label>
              <input type="email" id="Email" name="email" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Password -->
            <div class="col-span-6 sm:col-span-3">
              <label for="Password" class="block text-xs font-medium text-gray-700">Password</label>
              <input type="password" id="Password" name="password" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="col-span-6 sm:col-span-3">
              <label for="PasswordConfirmation" class="block text-xs font-medium text-gray-700">Konfirmasi Password</label>
              <input type="password" id="PasswordConfirmation" name="password_confirmation" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
            </div>

            <!-- Tanggal Mendaftar -->
            <div class="col-span-6 sm:col-span-3">
              <label for="RegisterDate" class="block text-xs font-medium text-gray-700">Tanggal Mendaftar</label>
              <input type="date" id="RegisterDate" name="tanggal_mendaftar" class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500 transition" required />
              @error('tanggal_mendaftar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Foto Profil -->
            <div class="col-span-6 sm:col-span-3">
              <label for="ProfilePhoto" class="block text-xs font-medium text-gray-700">Foto Profil</label>
              <div class="flex items-center">
                <label class="cursor-pointer inline-flex items-center px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-green-700 transition">
                  Pilih File
                  <input type="file" id="ProfilePhoto" name="foto" accept="image/*" class="hidden" onchange="updateFileName(this)" required />
                </label>
                <span id="file-name" class="ml-2 text-xs text-yellow-500">No file chosen</span>
              </div>
              @error('foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-span-6">
              <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-8 py-2 rounded-full hover:bg-blue-700 transition">
                Buat Akun
              </button>
              <p class="text-xs text-gray-500 mt-2">
                Sudah punya akun? <a href="{{ url('login') }}" class="text-blue-600 underline">Masuk</a>.
              </p>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>

  <script>
    function updateFileName(input) {
      const fileName = input.files[0]?.name || 'No file chosen';
      document.getElementById('file-name').textContent = fileName;
    }
  </script>
</body>
</html>
