<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pasien - SIPENKES</title>
    <link rel="icon" type="image/png" href="{{ asset('puskesmas logo.png') }}">
    @vite('resources/css/app.css')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        html,
        body {
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="font-poppins">
    <div class="min-h-screen bg-gray-50 p-8">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-green-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <i data-lucide="stethoscope" class="w-8 h-8 text-white"></i>
                        <h1 class="text-2xl font-bold text-white">Detail Pasien</h1>
                    </div>
                    <a href="{{ route('dokters.dokter') }}"
                        class="flex items-center space-x-2 text-white hover:text-green-100 transition-colors">
                        <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
                        <span class="font-medium">Kembali ke Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Patient Detail Card -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Patient Information -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                                <i data-lucide="user" class="w-5 h-5 mr-2"></i>
                                Informasi Pasien
                            </h2>
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Nomor Registrasi</dt>
                                    <dd class="font-medium text-gray-900">#{{ $administrasi->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Nama Lengkap</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->nama_pasien }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Jenis Pelayanan</dt>
                                    <dd class="font-medium text-green-600">{{ $administrasi->jenis_pelayanan }}</dd>
                                </div>
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Poli Tujuan</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->poli_tujuan }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Medical Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                                <i data-lucide="heart-pulse" class="w-5 h-5 mr-2"></i>
                                Data Medis
                            </h2>
                            <dl class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <dt class="text-sm text-gray-500">Tekanan Darah</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->tekanan_darah ?? '-' }}</dd>
                                </div>
                                <div class="col-span-1">
                                    <dt class="text-sm text-gray-500">Denyut Nadi</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->denyut_nadi ?? '-' }}</dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm text-gray-500">Keluhan Utama</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->keluhan_utama }}</dd>
                                </div>
                                <div class="col-span-1">
                                    <dt class="text-sm text-gray-500">Berat badan (kg)</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->bb }}</dd>
                                </div>
                                <div class="col-span-1">
                                    <dt class="text-sm text-gray-500">Tinggi badan (cm)</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->tb }}</dd>
                                </div>
                            </dl>
                        </div>

                    </div>

                    <!-- Visit Information -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                                <i data-lucide="calendar-check" class="w-5 h-5 mr-2"></i>
                                Informasi Kunjungan
                            </h2>
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Tanggal</dt>
                                    <dd class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($administrasi->tanggal_kunjungan)->isoFormat('D MMMM YYYY') }}
                                    </dd>
                                </div>
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Jam</dt>
                                    <dd class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($administrasi->jam_kunjungan)->format('H:i') }}
                                    </dd>
                                </div>
                                <div class="flex justify-between items-center border-b pb-2">
                                    <dt class="text-gray-600">Metode</dt>
                                    <dd class="font-medium text-gray-900">{{ $administrasi->metode_kunjungan }}</dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-gray-600">Status</dt>
                                    <dd class="font-medium">
                                        @if ($administrasi->status_administrasi == 'Diterima')
                                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                                                Diterima
                                            </span>
                                        @elseif ($administrasi->status_administrasi == 'Ditolak')
                                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-sm">
                                                Menunggu Konfirmasi
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Additional Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                                <i data-lucide="clipboard-list" class="w-5 h-5 mr-2"></i>
                                Informasi Tambahan
                            </h2>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm text-gray-500">Riwayat Penyakit</dt>
                                    <dd class="text-gray-900">{{ $administrasi->riwayat_penyakit ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">Riwayat Alergi</dt>
                                    <dd class="text-gray-900">{{ $administrasi->riwayat_alergi ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">Nomor BPJS</dt>
                                    <dd class="text-gray-900">{{ $administrasi->nomor_bpjs ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>
