<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Dokter - SIPENKES</title>
    <link rel="icon" type="image/png" href="{{ asset('images/puskesmas logo.png') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


    <style>
        @media (max-width: 768px) {
            .mobile-margin {
                margin-top: 4rem;
            }
        }
    </style>
</head>

<body class="h-full font-poppins bg-gray-100">
    <!-- Container utama -->
    <div class="h-full flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-green-600 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
            <div class="p-5">
                <!-- Logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo" class="w-12 h-12">
                    <div>
                        <h2 class="text-xl font-bold text-white">SIPENKES</h2>
                        <p class="text-green-100 text-sm">Dashboard Dokter</p>
                        <hr class="w-ful">
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <nav class="space-y-2">
                    <a href="#" data-section="dashboard"
                        class="menu-item flex items-center space-x-3 p-3 text-white bg-green-700 rounded-lg">
                        <i data-lucide="home" class="w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" data-section="data-pasien"
                        class="menu-item flex items-center space-x-3 p-3 text-white hover:bg-green-700 rounded-lg transition-colors">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Data Pasien</span>
                    </a>
                    <a href="#" data-section="buat-resep"
                        class="menu-item flex items-center space-x-3 p-3 text-white hover:bg-green-700 rounded-lg transition-colors">
                        <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        <span>Buat Resep</span>
                    </a>
                    <a href="#" data-section="riwayat-pasien"
                        class="menu-item flex items-center space-x-3 p-3 text-white hover:bg-green-700 rounded-lg transition-colors">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        <span>Riwayat Pasien</span>
                    </a>
                </nav>

                <!-- Logout -->
                <div class="mt-8 pt-4 border-t border-green-500">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 p-3 text-white hover:bg-green-700 rounded-lg transition-colors">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overlay Mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>

        <!-- Konten Utama -->
        <div class="flex-1 mobile-margin md:ml-64 p-6">
            <!-- Tombol Toggle Sidebar Mobile -->
            <button id="sidebarToggle"
                class="md:hidden fixed top-4 left-4 z-40 p-2 bg-green-600 text-white rounded-lg shadow-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <!-- Section Konten -->
            <div id="section" class="max-w-7xl mx-auto">
                <!-- Dashboard -->
                <div id="dashboard" class="section-content">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Dokter {{ session('user_email') }}
                        </h1>
                        <p class="text-gray-600">Ringkasan Aktivitas Hari Ini</p>
                    </div>

                    <!-- Statistik -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                                    <i data-lucide="activity" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold">{{ $antrianDiprosesCount }}</h3>
                                    <p class="text-gray-600 text-sm">Antrian Telah Selesai</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card statistik lainnya -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                                    <i data-lucide="user" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold">{{ $PasienMasuk }}</h3>
                                    <p class="text-gray-600 text-sm">Data Pasien Yang Masuk Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold">{{ $resepSelesai }}</h3>
                                    <p class="text-gray-600 text-sm">Resep Yang Sudah Selesai</p>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

                <!-- Data Pasien -->
                <div id="data-pasien" class="section-content hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-800">Data Pasien Masuk</h2>
                            <p class="text-gray-600 text-sm">Daftar Antrian Hari Ini</p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nomor Antrian
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($antrianTerbaru as $index => $antrian)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ $antrian->nomor_antrian }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $antrian->jenis_pelayanan }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($antrian->status == 'Menunggu')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm font-medium">
                                                        <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                                                        Menunggu
                                                    </span>
                                                @elseif ($antrian->status == 'Diproses')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                                        <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                                                        Diproses
                                                    </span>
                                                @elseif ($antrian->status == 'Selesai')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                                        <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                                        Selesai
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('dokter.antrian.detail', $antrian->nomor_antrian) }}"
                                                    class="inline-flex items-center text-green-600 hover:text-green-900 transition-colors">
                                                    <i data-lucide="arrow-right-circle" class="w-5 h-5 mr-1"></i>
                                                    Detail
                                                </a>

                                                @if ($antrian->status == 'Diproses')
                                                    <!-- Tombol untuk mengubah status menjadi Selesai -->
                                                    <form
                                                        action="{{ route('dokter.antrian.selesai', $antrian->nomor_antrian) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="ml-2 inline-flex items-center text-green-600 hover:text-green-900 transition-colors">
                                                            <i data-lucide="check-circle" class="w-5 h-5 mr-1"></i>
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($antrian->status == 'Menunggu')
                                                    <form
                                                        action="{{ route('dokter.antrian.proses', $antrian->nomor_antrian) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="ml-2 inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors">
                                                            <i data-lucide="check-circle" class="w-5 h-5 mr-1"></i>
                                                            Proses
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center text-gray-400">
                                                    <i data-lucide="frown" class="w-12 h-12 mb-2"></i>
                                                    <p class="text-sm font-medium">Tidak ada antrian untuk hari ini</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <!-- Isi tabel -->
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Cek jika ada pesan sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Buat Resep -->
                <div id="buat-resep" class="section-content hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <!-- Header Form -->
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                <i data-lucide="file-plus" class="w-6 h-6 mr-2 text-green-600"></i>
                                Formulir Resep Obat
                            </h2>
                            <p class="text-gray-600 text-sm mt-1">Isi data dengan lengkap dan benar</p>
                        </div>

                        <!-- Form Input -->
                        <form id="resep-form" action="{{ route('resep.store') }}" method="POST" class="space-y-6"
                            onsubmit="return validateForm()">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="dokter_id" class="block text-sm font-medium text-gray-700">Nama Dokter
                                        Pemeriksa</label>
                                    <select id="dokter_id" name="dokter_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($dokters as $dokter)
                                            <option value="{{ $dokter->id }}">{{ $dokter->nama_depan }}
                                                {{ $dokter->nama_belakang }}</option>
                                        @endforeach
                                    </select>
                                    @error('dokter_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="administrasi_id" class="block text-sm font-medium text-gray-700">Nama
                                        Pasien</label>

                                    @if ($pasienHariIni->isEmpty())
                                        <select disabled
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500">
                                            <option>-- Tidak ada pasien yang diterima hari ini --</option>
                                        </select>
                                        <p class="text-red-500 text-sm mt-1">Tidak ada pasien yang diterima hari ini.
                                        </p>
                                    @else
                                        <select name="administrasi_id" id="administrasi_id" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                            <option value="">-- Pilih Pasien --</option>
                                            @foreach ($pasienHariIni as $pasien)
                                                <option value="{{ $pasien->id }}">{{ $pasien->nama_pasien }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @error('administrasi_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div>
                                    <label for="tanggal_resep" class="block text-sm font-medium text-gray-700">Tanggal
                                        Resep</label>
                                    <input type="date" id="tanggal_resep" name="tanggal_resep"
                                        value="{{ now()->toDateString() }}" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                    @error('tanggal_resep')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama
                                        Obat</label>
                                    <input type="text" id="nama_obat" name="nama_obat" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                    @error('nama_obat')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dosis"
                                        class="block text-sm font-medium text-gray-700">Dosis</label>
                                    <input type="text" id="dosis" name="dosis" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                    @error('dosis')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jumlah"
                                        class="block text-sm font-medium text-gray-700">Jumlah</label>
                                    <input type="number" id="jumlah" name="jumlah" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                                    @error('jumlah')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-2">
                                    <label for="keterangan"
                                        class="block text-sm font-medium text-gray-700">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan" rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"></textarea>
                                    @error('keterangan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                                <button type="submit"
                                    class="w-full md:w-auto px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center justify-center">
                                    <i data-lucide="save" class="w-4 h-4 mr-2"></i> Kirim Data Ke Apoteker
                                </button>
                            </div>
                        </form>
                    </div>

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        </script>
                    @endif
                </div>


                <div id="riwayat-pasien" class="section-content hidden bg-white rounded-xl shadow-sm overflow-hidden">
                    <!-- Header with Search and Filter -->
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-history text-green-600 mr-2"></i>
                                Riwayat Pasien
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">Data lengkap resep pasien dalam 30 hari terakhir</p>
                        </div>

                        <!-- Filter Form -->
                        <form id="filterForm" method="GET"
                            class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <div class="relative flex-1">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" placeholder="Cari pasien"
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 w-full">
                            </div>

                            <div class="flex gap-2">
                                <select name="jenis_pelayanan"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                                    <option value="">Semua Pasien</option>
                                    <option value="Umum">Umum</option>
                                    <option value="BPJS">BPJS</option>
                                </select>

                                <select name="status_antrian"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                                    <option value="">Semua Status</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Menunggu">Menunggu</option>
                                </select>

                                <button type="button" id="filterButton"
                                    class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 flex items-center">
                                    <i class="fas fa-filter text-gray-500 mr-2"></i>
                                    Filter
                                </button>
                            </div>
                        </form>

                    </div>

                    <!-- Enhanced Table -->
                    <div class="overflow-x-auto">
                        <!-- Loading Indicator -->
                        <div id="loadingIndicator" style="display: none; text-align: center; margin: 10px 0;">
                            Mohon tunggu sebentar...
                        </div>
                        <table class="min-w-full divide-y divide-gray-200" id="patientsTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        <div class="flex items-center">
                                            No. Resep
                                            <i
                                                class="fas fa-sort ml-1 text-gray-400 hover:text-green-600 cursor-pointer"></i>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        Pasien
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        Dokter
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        <div class="flex items-center">
                                            Tanggal
                                            <i
                                                class="fas fa-sort ml-1 text-gray-400 hover:text-green-600 cursor-pointer"></i>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        Obat
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky top-0 bg-gray-50 z-10">
                                        Status
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($resepDokter as $resep)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <!-- No. Resep + ID -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-green-700">
                                                {{ $resep->kode_resep ?? 'RESEP-' . $resep->id }}</div>
                                            <div class="text-xs text-gray-500">ID: {{ $resep->id }}</div>
                                        </td>

                                        <!-- Nama Pasien + Inisial -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @php
                                                    $inisial = strtoupper(
                                                        substr($resep->administrasi->nama_pasien, 0, 2),
                                                    );
                                                    $warnaBg = ['bg-blue-100', 'bg-purple-100', 'bg-green-100'][
                                                        $resep->id % 3
                                                    ];
                                                    $warnaText = ['text-blue-600', 'text-purple-600', 'text-green-600'][
                                                        $resep->id % 3
                                                    ];
                                                @endphp
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full {{ $warnaBg }} flex items-center justify-center mr-3">
                                                    <span
                                                        class="{{ $warnaText }} font-medium">{{ $inisial }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium">{{ $resep->administrasi->nama }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $resep->administrasi->jenis_pelayanan ?? 'Umum' }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Dokter -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium">{{ $resep->dokter->nama_depan }}
                                                {{ $resep->dokter->nama_belakang }}</div>
                                            <div class="text-xs text-gray-500">{{ $resep->dokter->spesialis }}</div>
                                        </td>

                                        <!-- Tanggal Resep -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm">
                                                {{ \Carbon\Carbon::parse($resep->tanggal_resep)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">Resep ID: {{ $resep->id }}</div>
                                        </td>

                                        <!-- Info Obat -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-1 rounded mr-2">
                                                    <i class="fas fa-pills text-green-600 text-xs"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium">{{ $resep->nama_obat }}
                                                        ({{ $resep->jumlah }})
                                                    </div>
                                                    <div class="text-xs text-gray-500">Dosis: {{ $resep->dosis }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">{{ $resep->keterangan }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Status Antrian -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $status = $resep->antrian->status ?? 'Belum Ada';
                                                $statusClass =
                                                    $status === 'Selesai'
                                                        ? 'bg-green-100 text-green-800'
                                                        : 'bg-yellow-100 text-yellow-800';
                                            @endphp
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                @endforeach
                            </tbody>




                        </table>
                    </div>

                    <!-- Pagination and Summary -->
                    <div
                        class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span class="font-medium">1-2</span> dari <span class="font-medium">12</span>
                            resep
                        </div>
                        <div class="flex gap-1">
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50">
                                Sebelumnya
                            </button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium bg-gray-100 text-gray-700">
                                1
                            </button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                2
                            </button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
</body>


</html>
