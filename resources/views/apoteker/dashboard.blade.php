<!DOCTYPE html>
<html lang="en" x-data="{ menu: 'dashboard' }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apoteker - SIPENKES</title>
    <link rel="icon" type="image/png" href="{{ asset('images/puskesmas logo.png') }}">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Smooth transitions */
        .transition-slow {
            transition: all 0.3s ease;
        }
        
        /* Card hover effect */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Status badges */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }
        .badge-success {
            @apply bg-green-100 text-green-800;
        }
        .badge-warning {
            @apply bg-yellow-100 text-yellow-800;
        }
        .badge-danger {
            @apply bg-red-100 text-red-800;
        }
        .badge-info {
            @apply bg-blue-100 text-blue-800;
        }

        /* Form styling */
        .form-input {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200;
        }
        
        .form-select {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all duration-200;
        }
        
        .btn-primary {
            @apply bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-medium py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center;
        }
        
        .btn-secondary {
            @apply bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg border border-gray-300 transition-all duration-200 flex items-center justify-center;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
       <!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-emerald-600 to-emerald-800 text-white shadow-xl flex flex-col justify-between min-h-screen transition-slow">
    <!-- Logo Header -->
    <div class="p-5 border-b border-emerald-500 flex items-center space-x-3">
        <div class="p-2 bg-white rounded-lg shadow">
            <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo" class="w-8 h-8">
        </div>
        <div>
            <h1 class="text-lg font-bold">SIPENKES</h1>
            <p class="text-xs text-emerald-100 font-light">Apoteker Panel</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4 flex-1">
        <ul class="space-y-1">
            <li>
                <a href="#" @click.prevent="menu = 'dashboard'"
                    :class="menu === 'dashboard' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white'"
                    class="flex items-center p-3 rounded-lg transition-slow font-medium group">
                    <i class="fas fa-tachometer-alt mr-3 text-emerald-200 group-hover:text-white transition-slow" :class="menu === 'dashboard' ? 'text-white' : ''"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" @click.prevent="menu = 'resep'"
                    :class="menu === 'resep' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white'"
                    class="flex items-center p-3 rounded-lg transition-slow font-medium group">
                    <i class="fas fa-prescription mr-3 text-emerald-200 group-hover:text-white transition-slow" :class="menu === 'resep' ? 'text-white' : ''"></i>
                    <span>Resep Masuk</span>
                    <span class="ml-auto bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $resepMasuk }}</span>
                </a>
            </li>
            <li>
                <a href="#" @click.prevent="menu = 'laporan'"
                    :class="menu === 'laporan' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white'"
                    class="flex items-center p-3 rounded-lg transition-slow font-medium group">
                    <i class="fas fa-chart-bar mr-3 text-emerald-200 group-hover:text-white transition-slow" :class="menu === 'laporan' ? 'text-white' : ''"></i>
                    <span>Laporan</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User & Logout -->
    <div class="p-4 border-t border-emerald-500">
        <div class="flex items-center mb-4">
            <img src="https://ui-avatars.com/api/?name=Apoteker&background=059669&color=fff" 
                 alt="User" class="w-10 h-10 rounded-full mr-3 border-2 border-emerald-600">
            <div>
                <p class="text-sm font-medium">Apoteker</p>
                <p class="text-xs text-emerald-100">{{ session('user_email') }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white shadow-md transition-slow">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <h2 class="text-xl font-semibold text-gray-800" 
                            x-text="menu === 'dashboard' ? 'Dashboard' : menu === 'resep' ? 'Resep Masuk' : 'Laporan'"></h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="relative p-2 text-gray-500 hover:text-green-600 rounded-full hover:bg-gray-100 transition-slow">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                    {{ $resepMasuk }}
                                </span>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium hidden md:inline">Apoteker</span>
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Apoteker&background=4f46e5&color=fff" 
                                     alt="User" class="w-8 h-8 rounded-full cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Welcome Banner -->
                <div x-show="menu === 'dashboard'" 
                     class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl shadow-lg p-6 mb-6 card-hover">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">Selamat Datang, Apoteker</h1>
                            <p class="text-indigo-100 opacity-90">Anda memiliki {{ $resepMasuk }} resep yang perlu diproses hari ini.</p>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-full">
                            <i class="fas fa-pills text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div x-show="menu === 'dashboard'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Resep Masuk Hari Ini</p>
                                <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ $resepMasuk }}</h3>
                                <p class="text-xs text-gray-500 mt-1">+{{ round($resepMasuk/3) }} dari kemarin</p>
                            </div>
                            <div class="bg-indigo-50 p-3 rounded-lg text-indigo-600">
                                <i class="fas fa-prescription text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Content -->
                <div x-show="menu === 'laporan'">
                    <!-- Header Laporan -->
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl shadow-lg p-6 mb-6 card-hover">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-2xl font-bold mb-2">Laporan Farmasi</h1>
                                <p class="text-emerald-100 opacity-90">Laporan seputaran obat </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                <i class="fas fa-chart-line text-3xl"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Container Form Laporan -->
                    <div x-show="menu === 'laporan'"
                        class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8 space-y-6">
                        <h2 class="text-3xl font-semibold text-emerald-700 mb-4 flex items-center gap-3">
                            <i class="fas fa-file-alt text-emerald-600"></i>
                            Buat Laporan Farmasi
                        </h2>

                        <form action="{{ route('laporan.kirim') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Input Judul Laporan -->
                            <div>
                                <label for="judul_laporan" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                    Laporan</label>
                                <input type="text" id="judul_laporan" name="judul_laporan"
                                    placeholder="Masukkan judul laporan..." required
                                    class="form-input w-full rounded-md border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" />
                            </div>

                            <!-- Input Tanggal Laporan -->
                            <div>
                                <label for="tanggal_laporan"
                                    class="block text-sm font-medium text-gray-700 mb-1">Tanggal Laporan</label>
                                <input type="date" id="tanggal_laporan" name="tanggal_laporan" required
                                    class="form-input w-full rounded-md border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" />
                            </div>

                            <!-- Textarea Isi Laporan -->
                            <div>
                                <label for="isi_laporan" class="block text-sm font-medium text-gray-700 mb-1">Isi
                                    Laporan</label>
                                <textarea id="isi_laporan" name="isi_laporan" rows="6" placeholder="Tuliskan isi laporan secara detail..."
                                    required
                                    class="form-input w-full rounded-md border border-gray-300 px-4 py-3 resize-y focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"></textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="btn-primary flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                                    <i class="fas fa-paper-plane"></i> Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>

                    
                </div>
                @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session("success") }}',
                        timer: 2500,
                        showConfirmButton: false,
                    });
                </script>
                @endif
                
              

                <!-- Resep Masuk -->
                <div x-show="menu === 'resep'" class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-prescription-bottle-alt text-indigo-600 mr-2"></i>
                                Daftar Resep Masuk
                            </h2>
                            
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Resep
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pasien
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dokter
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Obat & Dosis
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($resepList as $resep)
                                    <tr class="hover:bg-gray-50 transition-slow">
                                        <!-- No. Resep + ID -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-indigo-700">
                                                {{ $resep->kode_resep ?? 'RESEP-' . $resep->id }}
                                            </div>
                                            <div class="text-xs text-gray-500">ID: {{ $resep->id }}</div>
                                        </td>

                                        <!-- Nama Pasien + Inisial -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @php
                                                    $namaPasien = $resep->administrasi->nama_pasien ?? 'Pasien';
                                                    $inisial = strtoupper(substr($namaPasien, 0, 2));
                                                    $colors = [
                                                        ['bg-blue-100', 'text-blue-800'],
                                                        ['bg-purple-100', 'text-purple-800'],
                                                        ['bg-green-100', 'text-green-800'],
                                                        ['bg-yellow-100', 'text-yellow-800'],
                                                        ['bg-indigo-100', 'text-indigo-800']
                                                    ];
                                                    $colorIndex = $resep->id % count($colors);
                                                @endphp
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full {{ $colors[$colorIndex][0] }} flex items-center justify-center mr-3">
                                                    <span class="{{ $colors[$colorIndex][1] }} font-medium">{{ $inisial }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $namaPasien }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $resep->administrasi->jenis_pelayanan ?? 'Umum' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Dokter -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $resep->dokter->nama_depan ?? '' }}
                                                {{ $resep->dokter->nama_belakang ?? '' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $resep->dokter->spesialis ?? '-' }}
                                            </div>
                                        </td>

                                        <!-- Info Obat -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="bg-indigo-100 p-1.5 rounded mr-2">
                                                    <i class="fas fa-pills text-indigo-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $resep->nama_obat }} ({{ $resep->jumlah }})
                                                    </div>
                                                    <div class="text-xs text-gray-500">Dosis: {{ $resep->dosis }}</div>
                                                    <div class="text-xs text-gray-500">{{ $resep->keterangan }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Tanggal Resep -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($resep->tanggal_resep)->format('d M Y') }}
                                            </div>
                                        </td>

                                        <!-- Status Antrian -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $status = $resep->antrian->status ?? 'Belum Ada';
                                                $statusClass = match ($status) {
                                                    'Selesai' => 'badge-success',
                                                    'Menunggu' => 'badge-warning',
                                                    'Dibatalkan' => 'badge-danger',
                                                    default => 'badge-info',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">{{ count($resepList) }}</span> dari <span class="font-medium">{{ $resepMasuk }}</span> hasil
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>