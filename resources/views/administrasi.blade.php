    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>SIPENKES - Administrasi</title>
    
      
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
                <img src="{{ asset('puskesmas logo.png') }}" alt="Logo Puskesmas" class="h-12 w-12 sm:h-14 sm:w-14">
              </a>
            @if (session('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
              </div>
            @endif

            @if (session('error'))
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
              </div>
            @endif

              <h1 class="mt-4 text-xl font-bold text-gray-900 sm:text-2xl md:text-3xl">
                Daftar Akun Administrasi💊
              </h1>
              <p class="mt-2 text-sm text-gray-500">
                Silakan isi formulir untuk membuat akun sebagai apoteker di Puskesmas.
              </p>
              <form action="{{ route('administrasi.register') }}" method="POST" enctype="multipart/form-data" class="mt-6 grid grid-cols-6 gap-4" onsubmit="return validateForm()">
                @csrf
                <div class="col-span-6 sm:col-span-3">
                  <label for="FirstName" class="block text-xs font-medium text-gray-700">Nama Depan</label>
                  <input type="text" id="FirstName" name="nama_depan" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="LastName" class="block text-xs font-medium text-gray-700">Nama Belakang</label>
                  <input type="text" id="LastName" name="nama_belakang" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6">
                  <label for="NIP" class="block text-xs font-medium text-gray-700">NIP</label>
                  <input type="text" id="NIP" name="NIP" pattern="\d{8,18}" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6">
                  <label for="Email" class="block text-xs font-medium text-gray-700">Email</label>
                  <input type="email" id="Email" name="email" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="Password" class="block text-xs font-medium text-gray-700">Password</label>
                  <input type="password" id="Password" name="password" minlength="6" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="PasswordConfirmation" class="block text-xs font-medium text-gray-700">Konfirmasi Password</label>
                  <input type="password" id="PasswordConfirmation" name="password_confirmation" required class="mt-1 w-full rounded-md border border-gray-300 bg-white text-xs text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="ProfilePhoto" class="block text-xs font-medium text-gray-700">Foto Profil</label>
                  <input type="file" id="ProfilePhoto" name="foto" accept="image/*" required class="mt-1 w-full text-xs text-gray-700">
                </div>
                <div class="col-span-6">
                  <label for="MarketingAccept" class="flex gap-2 items-center">
                    <input type="checkbox" id="MarketingAccept" name="marketing_accept" required class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-xs text-gray-700">Saya ingin menerima informasi terbaru melalui email.</span>
                  </label>
                </div>
                <div class="col-span-6 flex flex-col sm:flex-row items-start gap-4">
                  <button type="submit" class="w-full sm:w-auto rounded-full border border-blue-600 bg-blue-600 px-8 py-2 text-xs font-medium text-white hover:bg-blue-700 focus:ring-3 focus:outline-none shadow-md">
                    Buat Akun
                  </button>
                  <p class="text-xs text-gray-500">
                    Sudah punya akun? <a href="{{ url ('login') }}" class="text-gray-700 underline hover:text-blue-600">Masuk</a>.
                  </p>
                </div>
              </form>
            </div>
          </main>
        </div>
      </section>
      <script>
        function validateForm() {
          let password = document.getElementById("Password").value;
          let confirmPassword = document.getElementById("PasswordConfirmation").value;
          if (password !== confirmPassword) {
            alert("Password dan Konfirmasi Password tidak cocok!");
            return false;
          }
          return true;
        }
      </script>
    </body>
    </html>