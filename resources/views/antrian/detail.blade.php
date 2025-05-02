<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Antrian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-xl rounded-xl p-6 w-full max-w-lg hover:shadow-2xl transition-all duration-300">
        <div class="flex items-center justify-between border-b pb-3 mb-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Antrian</h2>
            <span class="text-sm text-gray-500">{{ $antrian->created_at->format('d M Y H:i') }}</span>
        </div>

        <div class="space-y-5">
            <!-- Nomor Antrian -->
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21v-6M9 3L5 10m4-7l4 7m4 0h5m-5 0a2 2 0 110-4m5 4a2 2 0 11-4 0"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Nomor Antrian</p>
                    <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $antrian->nomor_antrian }}</p>
                </div>
            </div>

            <!-- Nama Pasien -->
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Nama Pasien</p>
                    <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $antrian->administrasi->nama_pasien ?? '-' }}</p>
                </div>
            </div>

            <!-- Status -->
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276a2 2 0 00-1.106-3.724L8.553 8.276a2 2 0 001.106 3.724L15 10zm0 0l4.553 2.276a2 2 0 01-1.106 3.724L8.553 15.276a2 2 0 01-1.106-3.724L15 10z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Status</p>
                    <p class="text-lg md:text-xl font-semibold text-gray-900">{{ $antrian->status }}</p>
                </div>
            </div>

            <!-- Jenis Pasien -->
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-100 text-purple-600 rounded-xl">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-8-4h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Jenis Pasien</p>
                    <p class="text-lg md:text-xl font-semibold text-gray-900">{{ $antrian->administrasi->jenis_pelayanan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('antrian.index') }}" class="w-full block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
