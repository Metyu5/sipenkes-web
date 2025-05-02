<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPENKES</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('puskesmas logo.png') }}">
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    @vite('resources/css/app.css')
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-poppins">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Navbar -->
    <header x-data="{ scrolled: false, openMobile: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
        :class="{ 'bg-white shadow-md': scrolled, 'bg-transparent': !scrolled }"
        class="fixed top-0 w-full z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center animate__animated animate__fadeInDown"
            style="--animate-duration: 1.8s;">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo SIPENKES PAGUYAMAN" class="h-10">
                <span class="text-xl font-black text-green-700 tracking-wide">SIPENKES PAGUYAMAN</span>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-6 text-green-700 font-medium ml-auto">
                <li>
                    <a href="#features" class="hover:text-green-600">Visi &amp; Misi</a>
                </li>
                <!-- Tentang Dropdown Desktop -->
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center hover:text-green-600">
                        Tentang
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute mt-2 w-48 bg-white shadow-md rounded-md py-2">
                        <a href="#profil" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil Puskesmas</a>
                        <a href="#data" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Luas Wilayah
                            Puskesmas</a>
                    </div>
                </li>

                <li><a href="#layanan" class="hover:text-green-600">Layanan</a></li>
                <li><a href="#jam" class="hover:text-green-600">Jam Operasional</a></li>

                <!-- Daftar Dropdown Desktop -->
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center hover:text-green-600">
                        Daftar
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute mt-2 w-40 bg-white shadow-md rounded-md py-2">
                        <a href="{{ url('/apoteker') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Apoteker</a>
                        <a href="{{ url('/administrasi') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Administrasi</a>
                        <a href="{{ url('/formdokter') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dokter</a>
                    </div>
                </li>
            </ul>

            <!-- Mobile Menu Button -->
            <button @click="openMobile = !openMobile" class="md:hidden focus:outline-none text-gray-700">
                <svg x-show="!openMobile" class="w-6 h-6 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg x-show="openMobile" class="w-6 h-6 transition-transform duration-300 rotate-90" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </nav>

        <!-- Mobile Sidebar Menu (Slide from Right) -->
        <div x-show="openMobile" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed top-0 right-0 h-full w-3/4 bg-white shadow-lg py-4 px-6 md:hidden z-50">
            <!-- Tombol Tutup Sidebar -->
            <button @click="openMobile = false" class="absolute top-4 right-4 focus:outline-none text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex flex-col space-y-1 mt-2">
                <a href="#features" class="block text-gray-700 hover:text-green-600 py-2"
                    @click="openMobile = false">Visi &amp; Misi</a>

                <!-- Mobile Dropdown for Tentang -->
                <div x-data="{ openTentang: false }">
                    <button @click="openTentang = !openTentang"
                        class="w-full text-left text-gray-700 hover:text-green-600 py-2 flex justify-between">
                        Tentang
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="openTentang" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="#profil" class="block text-gray-700 hover:bg-gray-100 py-2"
                            @click="openMobile = false">Profil Puskesmas</a>
                        <a href="#data" class="block text-gray-700 hover:bg-gray-100 py-2"
                            @click="openMobile = false">Luas Wilayah Puskesmas</a>
                    </div>
                </div>

                <a href="#layanan" class="block text-gray-700 hover:text-green-600 py-2"
                    @click="openMobile = false">Layanan</a>
                <a href="#jam" class="block text-gray-700 hover:text-green-600 py-2"
                    @click="openMobile = false">Jam Operasional</a>

                <!-- Mobile Dropdown for Daftar -->
                <div x-data="{ openDropdown: false }">
                    <button @click="openDropdown = !openDropdown"
                        class="w-full text-left text-gray-700 hover:text-green-600 py-2 flex justify-between">
                        Daftar
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="openDropdown" x-transition class="mt-2 space-y-1 pl-4">
                        <a href="{{ url('/apoteker') }}" class="block text-gray-700 hover:bg-gray-100 py-2"
                            @click="openMobile = false">Apoteker</a>
                        <a href="{{ url('/administrasi') }}" class="block text-gray-700 hover:bg-gray-100 py-2"
                            @click="openMobile = false">Administrasi</a>
                        <a href="{{ url('/formdokter') }}" class="block text-gray-700 hover:bg-gray-100 py-2"
                            @click="openMobile = false">Dokter</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- Navbar end --}}

    <!-- Hero Section Fullscreen -->
    <section class="relative min-h-screen flex items-center bg-green-100">
        <div class="max-w-7xl mx-auto w-full px-6 md:px-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Teks (Mobile: order-1, Desktop: order-1) -->
            <div class="order-1 text-left animate__animated animate__fadeInLeft" style="--animate-duration: 1.5s;">
                <h2 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">
                    Selamat Datang di <span class="text-green-600">SIPENKES</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-700 font-medium mb-6">
                    Sistem Informasi Pelayanan Kesehatan Paguyaman untuk meningkatkan kualitas layanan kesehatan.
                </p>
                <a href="{{ url('/login') }}"
                class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold px-10 py-3 rounded-lg text-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:from-green-600 hover:to-green-700 group">
                Login
                <svg class="w-6 h-6 text-white transition-transform duration-300 group-hover:rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
                </svg>
            </a>
            
            </div>
            <!-- Gambar (Mobile: order-2, Desktop: order-2) -->
            <div class="order-2 animate__animated animate__fadeInRight"
                style="--animate-duration: 1.8s; position: relative;">
                <img src="{{ asset('images/latar.jpg') }}" alt="Puskesmas Paguyaman"
                    class="w-full h-auto rounded-xl shadow-lg">
                <div class="absolute inset-0 bg-black bg-opacity-20 rounded-xl"></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->

    <!-- Visi & Misi Section -->
    <section id="features" class="py-24 bg-gradient-to-r from-green-100 to-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <!-- Judul -->
            <h2 class="text-4xl font-bold mb-12 text-green-700" data-aos="fade-up" data-aos-duration="1000">
                Visi &amp; Misi
            </h2>

            <div class="space-y-8 max-w-4xl mx-auto">
                <!-- Card Visi -->
                <details
                    class="group relative overflow-hidden p-6 bg-white border-l-4 border-green-600 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
                    open data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-bottom">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 outline-none">
                        <h2 class="text-lg md:text-xl font-semibold text-gray-800">Visi</h2>
                        <!-- Ikon Expand/Collapse -->
                        <span
                            class="shrink-0 rounded-full bg-white p-2 text-gray-900 transition-transform duration-300 group-open:rotate-45">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-left font-semibold text-gray-700">
                        “Terwujudnya Kecamatan Paguyaman yang Mandiri dan Peduli terhadap kesehatan demi terwujudnya
                        Kabupaten
                        Boalemo yang Damai, Cerdas, Sejahtera dalam Suasana Religius.”
                    </p>
                </details>

                <!-- Card Misi -->
                <details
                    class="group relative overflow-hidden p-6 bg-white border-l-4 border-green-600 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
                    data-aos="fade-left" data-aos-duration="1000" data-aos-anchor-placement="top-bottom">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 outline-none">
                        <h2 class="text-lg md:text-xl font-semibold text-gray-800">Misi</h2>
                        <!-- Ikon Expand/Collapse -->
                        <span
                            class="shrink-0 rounded-full bg-white p-2 text-gray-900 transition-transform duration-300 group-open:rotate-45">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </summary>
                    <ol class="mt-4 space-y-2 list-decimal list-inside text-left font-semibold text-gray-700">
                        <li data-aos="fade-up" data-aos-duration="800">Memberikan pelayanan kesehatan yang bermutu,
                            proaktif,
                            terjangkau, paripurna, dan terintegrasi.</li>
                        <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Menjadikan Puskesmas
                            Paguyaman sebagai
                            pusat penggerak peran serta masyarakat.</li>
                        <li data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">Menerapkan manajemen
                            yang transparan pada
                            setiap program.</li>
                        <li data-aos="fade-up" data-aos-duration="1400" data-aos-delay="300">Melakukan acara
                            keagamaan secara rutin.</li>
                    </ol>
                </details>
            </div>
        </div>
    </section>
    <section id="about" class="py-24 bg-gray-50" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 mb-12 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('images/latar.jpg') }}" alt="Tentang SIPENKES"
                    class="w-full h-auto rounded-xl shadow-2xl">
            </div>
            <div class="w-full md:w-1/2 md:pl-16 text-left" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-6">
                    Tentang <span class="text-green-600">SIPENKES</span>
                </h2>
                <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                    SIPENKES adalah platform digital inovatif yang mengubah cara pelayanan kesehatan di Paguyaman.
                    Dengan antarmuka yang intuitif dan sistem terintegrasi, kami hadir untuk memudahkan pendaftaran,
                    konsultasi, dan pemantauan kesehatan secara real-time. Nikmati layanan kesehatan berkualitas dengan
                    teknologi terkini, sehingga setiap masyarakat dapat merasakan perawatan terbaik kapan saja, di mana
                    saja.
                </p>
                <a href="#services"
                    class="inline-block bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-10 py-4 rounded-full shadow-lg transform transition hover:scale-105">
                    Lihat Layanan Kami
                </a>
            </div>
        </div>
    </section>

<!-- Profil Dokter Umum & Jadwal Praktek Section -->
<section id="layanan" class="py-24 bg-blue-500/10">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-12" data-aos="fade-up" data-aos-duration="1000">
      Profil Dokter Umum &amp; Jadwal Praktek
    </h2>
    <!-- Grid untuk Card Dokter -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
      <!-- Card Dokter Pertama -->
      <a href="#"
         class="relative block overflow-hidden rounded-2xl border border-gray-100 p-8 bg-white transition-transform duration-500 ease-in-out hover:scale-105 shadow-lg hover:shadow-2xl"
         data-aos="fade-up" data-aos-duration="1200">
        <!-- Bar aksen -->
        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>
        <div class="sm:flex sm:justify-between sm:items-center sm:gap-6">
          <div>
            <h3 class="text-2xl font-bold text-gray-900">
              Dokter Umum
            </h3>
            <p class="mt-1 text-sm font-medium text-gray-600">By dr. Annisa Sarining Puspa</p>
          </div>
          <div class="block sm:block sm:shrink-0">
            <img src='images/secondary.jpg' alt="Foto Dokter"
                 class="w-20 h-20 rounded-xl object-cover shadow-md">
          </div>
        </div>
        <div class="mt-6">
          <p class="text-base text-gray-500">
            Desa Tenilo, Klaster 2
          </p>
        </div>
        <dl class="mt-6 flex gap-8">
          <div class="flex flex-col-reverse">
            <dt class="text-sm font-medium text-gray-600">08.00-14.00</dt>
            <dd class="text-xs text-gray-500">Jadwal Pelayanan</dd>
          </div>
          <div class="flex flex-col-reverse">
            <dt class="text-sm font-medium text-gray-600">Ready</dt>
            <dd class="text-xs text-gray-500">Ket</dd>
          </div>
        </dl>
      </a>
      <a href="#"
         class="relative block overflow-hidden rounded-2xl border border-gray-100 p-8 bg-white transition-transform duration-500 ease-in-out hover:scale-105 shadow-lg hover:shadow-2xl"
         data-aos="fade-up" data-aos-duration="1200">
        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>
        <div class="sm:flex sm:justify-between sm:items-center sm:gap-6">
          <div>
            <h3 class="text-2xl font-bold text-gray-900">
              Dokter Umum
            </h3>
            <p class="mt-1 text-sm font-medium text-gray-600">By dr. Dwi Adharia Saraswati</p>
          </div>
          <div class="block sm:block sm:shrink-0">
            <img src="images/secondary.jpg" alt="Foto Dokter"
                 class="w-20 h-20 rounded-xl object-cover shadow-md">
          </div>
        </div>
        <div class="mt-6">
          <p class="text-base text-gray-500">
            Desa Wonggahu, Klaster 3
          </p>
        </div>
        <dl class="mt-6 flex gap-8">
          <div class="flex flex-col-reverse">
            <dt class="text-sm font-medium text-gray-600">08.00-14.00</dt>
            <dd class="text-xs text-gray-500">Jadwal Pelayanan</dd>
          </div>
          <div class="flex flex-col-reverse">
            <dt class="text-sm font-medium text-gray-600">Ready</dt>
            <dd class="text-xs text-gray-500">Ket</dd>
          </div>
        </dl>
      </a>
    </div>
  </div>
</section>
    <!-- Jam Operasional Puskesmas Section -->
    <section id="jam" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12" data-aos="fade-up"
                data-aos-duration="1000">
                Jam Operasional Puskesmas
            </h2>
            <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-8">
                    <!-- Pelayanan Pendaftaran Card -->
                    <div class="rounded-2xl border border-gray-200 p-6 shadow-xs sm:px-8 lg:p-12 min-h-[300px] flex flex-col justify-start transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                        data-aos="fade-left" data-aos-duration="1000">
                        <div class="text-center">
                            <h2 class="text-lg font-medium text-gray-900">
                                Pelayanan Pendaftaran
                                <span class="sr-only">Plan</span>
                            </h2>
                            <p class="mt-2 sm:mt-4">
                                <strong class="text-3xl font-bold text-gray-900 sm:text-4xl">Senin - Kamis</strong>
                            </p>
                        </div>
                        <ul class="mt-6 space-y-2">
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 text-indigo-700 transition-transform duration-300 hover:scale-110">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="text-gray-700">08.00 - 12.00</span>
                            </li>
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 text-indigo-700 transition-transform duration-300 hover:scale-110">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="text-gray-700">08.00 - 11.00</span>
                            </li>
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 text-indigo-700 transition-transform duration-300 hover:scale-110">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="text-gray-700">08.00 - 12.00</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Pelayanan Kesehatan Card -->
                    <div class="rounded-2xl border border-indigo-600 p-6 ring-1 shadow-xs ring-indigo-600 sm:px-8 lg:p-12 min-h-[300px] flex flex-col justify-start transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                        data-aos="fade-right" data-aos-duration="1000">
                        <div class="text-center">
                            <h2 class="text-lg font-medium text-gray-900">
                                Pelayanan Kesehatan
                                <span class="sr-only">Plan</span>
                            </h2>
                        </div>
                        <ul class="mt-6 space-y-2">
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 text-indigo-700 transition-transform duration-300 hover:scale-110">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="text-gray-700">08.00 - 14.00 WITA</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Profil Puskesmas Section -->
    <section id="profil" class="py-24 bg-gray-100" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">
                Profil Puskesmas
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Map Section -->
                <div class="w-full" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Leaflet Map -->
                    <div id="map" style="height: 350px; border-radius: 8px;"></div>
                </div>

                <!-- Sejarah Section -->
                <div class="w-full" data-aos="fade-left" data-aos-duration="1000">
                    <h3 class="text-3xl font-semibold text-green-600 mb-4">
                        Sejarah Puskesmas
                    </h3>
                    <p class="text-lg text-gray-700 leading-relaxed mb-4">
                        Puskesmas ini didirikan pada tahun 1990 dan telah menjadi pusat layanan kesehatan terintegrasi
                        bagi masyarakat setempat. Sejak awal, kami berfokus pada pemberian pelayanan yang berkualitas,
                        terjangkau, dan mudah diakses.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed mb-4">
                        Seiring waktu, puskesmas terus berinovasi dengan menerapkan teknologi terbaru dan meningkatkan
                        kompetensi tenaga medis. Pendekatan ini memungkinkan kami untuk memberikan layanan yang lebih
                        responsif dan adaptif terhadap kebutuhan masyarakat.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Dengan sejarah yang panjang dan pencapaian yang membanggakan, puskesmas kami berkomitmen untuk
                        terus berkembang, mendukung kesehatan masyarakat, serta menjadi garda terdepan dalam pelayanan
                        kesehatan lokal.
                    </p>
                </div>
            </div>

            <!-- Keadaan Geografis dan Administrasi -->
            <div class="mt-16" data-aos="fade-up" data-aos-duration="1000">
                <h3 class="text-3xl font-semibold text-green-600 mb-4">
                    Keadaan Geografis dan Administrasi
                </h3>
                <div class="prose max-w-none text-gray-700">
                    <p>
                        Keadaan geografis wilayah Puskesmas Paguyaman terdiri dari daratan, persawahan, dan daerah
                        pegunungan dengan luas <strong>220.928 km<sup>2</sup></strong>, dengan batas-batas wilayah
                        sebagai berikut:
                    </p>
                    <ol class="list-decimal list-inside mb-4">
                        <li>Sebelah utara berbatasan dengan Kecamatan Tolangohula</li>
                        <li>Sebelah timur berbatasan dengan Kecamatan Boliyohuto</li>
                        <li>Sebelah selatan berbatasan dengan Kecamatan Paguyaman Pantai</li>
                        <li>Sebelah barat berbatasan dengan Kecamatan Dulupi</li>
                    </ol>
                    <p>
                        Ditinjau dari sisi wilayah pemerintahan, Kecamatan Paguyaman terdiri dari 22 Desa dan 104 Dusun,
                        dengan jarak rata-rata dari pusat kecamatan ke desa sebesar 5 KM dan jarak terjauh mencapai 17
                        KM. Jarak antara kecamatan ke ibu kota kabupaten adalah 50 KM, sedangkan jarak dari Puskesmas ke
                        provinsi adalah 100 KM. Di antara 11 desa yang berada di wilayah Puskesmas Paguyaman, desa yang
                        terjauh adalah Desa Girisa.
                    </p>
                    <p>
                        Semua desa yang ada di wilayah Puskesmas Paguyaman dapat dijangkau dengan kendaraan bermotor
                        roda 4 dan roda 2, namun pada kondisi tertentu (misalnya musim hujan), terdapat desa-desa yang
                        sulit dijangkau. Beberapa dusun di desa tersebut, seperti di Desa Balate Jaya, memiliki akses
                        yang terbatas. Dengan adanya upaya pemerintah yang telah banyak memfasilitasi Puskesmas dengan
                        kendaraan dinas, kegiatan pelayanan kesehatan dapat dilakukan dengan lebih mudah, meskipun masih
                        ada penduduk yang tinggal di daerah pegunungan sehingga pengumpulan data dan pelaksanaan
                        kunjungan rumah kadang dilakukan dengan jalan kaki.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section id="data" class="py-12 bg-gray-50" data-aos="fade-up" data-aos-duration="500">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">
                LUAS WILAYAH PUSKESMAS PAGUYAMAN
            </h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" data-aos="fade-up" data-aos-duration="800">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-gradient-to-r from-green-500 to-green-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Desa</th>
                            <th scope="col" class="px-6 py-3">Luas Wilayah (km<sup>2</sup>)</th>
                            <th scope="col" class="px-6 py-3">Persentase (%)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Tangkobu</td>
                            <td class="px-6 py-4">6,51</td>
                            <td class="px-6 py-4">4.94</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Rejonegoro</td>
                            <td class="px-6 py-4">10,73</td>
                            <td class="px-6 py-4">8.14</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Sosial</td>
                            <td class="px-6 py-4">8,23</td>
                            <td class="px-6 py-4">6.24</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Molombulahe</td>
                            <td class="px-6 py-4">5,10</td>
                            <td class="px-6 py-4">3.87</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Kuala Lumpur</td>
                            <td class="px-6 py-4">6,44</td>
                            <td class="px-6 py-4">4.88</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Wonggahu</td>
                            <td class="px-6 py-4">12,52</td>
                            <td class="px-6 py-4">9.49</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Tenilo</td>
                            <td class="px-6 py-4">15,84</td>
                            <td class="px-6 py-4">12.01</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Hulawa</td>
                            <td class="px-6 py-4">3,22</td>
                            <td class="px-6 py-4">2.44</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Balate Jaya</td>
                            <td class="px-6 py-4">7,51</td>
                            <td class="px-6 py-4">5.69</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Girisa</td>
                            <td class="px-6 py-4">25,75</td>
                            <td class="px-6 py-4">19.52</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">Karya Murni</td>
                            <td class="px-6 py-4">30,05</td>
                            <td class="px-6 py-4">22.78</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="px-6 py-4 font-bold text-gray-900">Jumlah</td>
                            <td class="px-6 py-4 font-bold text-gray-900">131,9 Km<sup>2</sup></td>
                            <td class="px-6 py-4 font-bold text-gray-900">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="flex items-center justify-center py-20 bg-white min-w-screen">
        <div class="px-16 bg-white">
            <div class="container flex flex-col items-start mx-auto lg:items-center">
                <p class="relative flex items-start justify-start w-full text-lg font-bold tracking-wider text-purple-500 uppercase lg:justify-center lg:items-center" data-aos="fade-down" data-aos-duration="1000">Don't just take our word for it</p>
                <h2 class="relative flex items-start justify-start w-full max-w-3xl text-5xl font-bold lg:justify-center" data-aos="fade-up" data-aos-duration="1000">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="absolute right-0 hidden w-12 h-12 -mt-2 -mr-16 text-gray-200 lg:inline-block" viewBox="0 0 975.036 975.036">
                        <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                    </svg>
                    Apa Kata Masyarakat?
                </h2>
                <div class="block w-full h-0.5 max-w-lg mt-6 bg-purple-100 rounded-full" data-aos="fade-up" data-aos-duration="1000"></div>
    
                <div class="items-center justify-center w-full mt-12 mb-4 lg:flex">
                    <!-- Testimoni 1 -->
                    <div class="flex flex-col items-start justify-start w-full h-auto mb-12 lg:w-1/3 lg:mb-0" data-aos="fade-right" data-aos-duration="1000">
                        <div class="flex items-center justify-center">
                            <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                                <img src="{{ asset('images/download (2).jpeg') }}" class="object-cover w-full h-full">
                            </div>
                            <div class="flex flex-col items-start justify-center">
                                <h4 class="font-bold text-gray-800">Syahrul DJ</h4>
                                <p class="text-gray-600">Pelajar</p>
                            </div>
                        </div>
                        <blockquote class="mt-8 text-lg text-gray-500">"SIPENKES sangat membantu saya dalam mengakses layanan kesehatan dengan mudah. Proses pendaftaran dan konsultasi berjalan lancar!"</blockquote>
                    </div>
    
                    <!-- Testimoni 2 -->
                    <div class="flex flex-col items-start justify-start w-full h-auto px-0 mx-0 mb-12 border-l border-r border-transparent lg:w-1/3 lg:mb-0 lg:px-8 lg:mx-8 lg:border-gray-200" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="flex items-center justify-center">
                            <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                                <img src="{{ asset('images/Nailoong.jpeg') }}" class="object-cover w-full h-full">
                            </div>
                            <div class="flex flex-col items-start justify-center">
                                <h4 class="font-bold text-gray-800">Iramaya</h4>
                                <p class="text-gray-600">Pelajar</p>
                            </div>
                        </div>
                        <blockquote class="mt-8 text-lg text-gray-500">"Wow! SIPENKES membantu saya di segala hal, terutama dalam pengurusan administrasi. Sukses selalu, Sipenkes!"</blockquote>
                    </div>
    
                    <!-- Testimoni 3 -->
                    <div class="flex flex-col items-start justify-start w-full h-auto lg:w-1/3" data-aos="fade-left" data-aos-duration="1000">
                        <div class="flex items-center justify-center">
                            <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                                <img src="{{ asset('images/Agent Minion.jpeg') }}" class="object-cover w-full h-full">
                            </div>
                            <div class="flex flex-col items-start justify-center">
                                <h4 class="font-bold text-gray-800">Matthew</h4>
                                <p class="text-gray-600">Backend Developer</p>
                            </div>
                        </div>
                        <blockquote class="mt-8 text-lg text-gray-500">"Semoga Puskesmas Paguyaman Terpadu Dapat Berkembang Dan Terus Sukses!"</blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gradient-to-r" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
            <p class="text-xl text-gray-600 mb-8">
                Untuk pertanyaan lebih lanjut atau informasi, hubungi kami di:
            </p>
            <a href="mailto:info@sipenkes.com"
                class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-full shadow-md transition transform duration-300 hover:scale-105 hover:bg-blue-700"
                data-aos="zoom-in" data-aos-duration="800">
                info@sipenkes.com
            </a>
        </div>
    </section>
    
    <footer class="bg-blue-600 text-white py-10" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center space-y-6 text-center">
          <!-- Logo & Judul -->
          <div data-aos="zoom-in" data-aos-duration="800">
            <img
              src="{{ asset('images/puskesmas logo.png') }}"
              alt="Logo SIPENKES"
              class="mx-auto mb-3 w-16 h-16 object-contain"
            />
            <h2 class="text-2xl font-bold">SIPENKES</h2>
            <p class="text-sm">
              Sistem Informasi Pelayanan Kesehatan Paguyaman
            </p>
          </div>
      
          <!-- Navigasi -->
          <nav class="space-x-4 text-sm" data-aos="fade-up" data-aos-delay="200">
            <a href="#features" class="hover:underline">Visi &amp; Misi</a>
            <a href="#profil" class="hover:underline">Profil Puskesmas</a>
            <a href="#data" class="hover:underline">Luas Wilayah Puskesmas</a>
            <a href="#layanan" class="hover:underline">Layanan</a>
            <a href="#jam" class="hover:underline">Jam Operasional</a>
            <a href="#" class="hover:underline">Daftar</a>
          </nav>
      
          <!-- Sosial Media -->
          <div class="flex space-x-4" data-aos="fade-up" data-aos-delay="400">
            <a href="https://www.facebook.com/puskesmas.paguyaman?locale=id_ID" target="_blank" rel="noopener noreferrer" class="hover:text-gray-200">
              <span class="sr-only">Facebook</span>
              <i class="fa-brands fa-facebook fa-lg"></i>
            </a>
            <a href="https://www.instagram.com/puskesmaspaguyaman/" target="_blank" rel="noopener noreferrer" class="hover:text-gray-200">
              <span class="sr-only">Instagram</span>
              <i class="fa-brands fa-instagram fa-lg"></i>
            </a>
          </div>
      
          <!-- Copyright -->
          <p class="text-sm" data-aos="fade-up" data-aos-delay="600">
            &copy; {{ date('Y') }} - All rights reserved
          </p>
        </div>
      </footer>
</body>

</html>
