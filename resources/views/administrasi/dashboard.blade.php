<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administrasi - SIPENKES</title>
  <link rel="icon" type="image/png" href="{{ asset('images/puskesmas logo.png') }}">
  @vite('resources/css/app.css')
  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="h-full font-poppins bg-gray-50">
  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Mobile Header -->
    <header class="md:hidden bg-green-600 p-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo Puskesmas" class="w-10 h-10">
        <span class="text-white font-bold text-lg">SIPENKES</span>
      </div>
      <button id="toggleSidebar" class="p-2 text-white rounded-lg">
        <i id="menuIcon" data-lucide="menu"></i>
        <i id="closeIcon" data-lucide="x" class="hidden"></i>
      </button>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-green-600 text-white fixed md:relative inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
      <div class="p-5 h-full flex flex-col">
        <div class="space-y-2 mb-8 hidden md:block">
          <div class="flex items-center space-x-4">
            <img src="{{ asset('images/puskesmas logo.png') }}" alt="Logo Puskesmas" class="w-12 h-12">
            <div class="flex flex-col">
              <h2 class="text-2xl font-bold">SIPENKES</h2>
              <p class="text-sm text-green-100">Dashboard Administrasi</p>
            </div>
          </div>
          <hr class="mt-4 border-green-500">
        </div>

        <nav class="flex-1">
          <ul class="space-y-2">
            <li>
              <a href="#" id="menuDashboard" class="menu-item flex items-center space-x-3 p-3 rounded-lg bg-green-700 font-medium">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="#" id="menuAdministrasi" class="menu-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                <span>Administrasi</span>
              </a>
            </li>
            <li>
              <a href="{{ route('antrian.index') }}" class="menu-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i data-lucide="list-restart" class="w-5 h-5"></i>
                <span>Daftar Antrian</span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="mt-auto pt-4 border-t border-green-500">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-red-500 transition-colors duration-200 font-medium">
              <i data-lucide="log-out" class="w-5 h-5"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-6 overflow-x-hidden">
      <!-- Desktop Header -->
      <header class="mb-6 hidden md:block">
        <h1 id="headerTitle" class="text-3xl font-bold text-green-700">Dashboard Administrasi</h1>
        <p class="text-gray-600">Selamat datang Petugas Administrasi, {{ session('user_email') }}</p>
      </header>

      <!-- Dashboard Content -->
      <div id="dashboardContent">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
          <!-- Card 1: Total Antrian -->
          <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start">
              <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Antrian Hari Ini</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $totalAntrian }}</p>
              </div>
              <div class="bg-green-100 p-3 rounded-lg group-hover:bg-green-200 transition-colors duration-300">
                <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
              <i data-lucide="activity" class="w-4 h-4 mr-2"></i>
              <span>Update real-time</span>
            </div>
          </div>
      
          <!-- Card 2: Pasien BPJS -->
          <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start">
              <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Pasien BPJS</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $pasienBPJS }}</p>
              </div>
              <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                <i data-lucide="id-card" class="w-6 h-6 text-blue-600"></i>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
              <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
              <span>Update terakhir: {{ now()->format('H:i') }}</span>
            </div>
          </div>
      
          <!-- Card 3: Pasien Umum -->
          <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start">
              <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Pasien Umum</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $pasienUmum }}</p>
              </div>
              <div class="bg-purple-100 p-3 rounded-lg group-hover:bg-purple-200 transition-colors duration-300">
                <i data-lucide="user" class="w-6 h-6 text-purple-600"></i>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
              <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
              <span>Update terakhir: {{ now()->format('H:i') }}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Administrasi Content -->
      <div id="administrasiContent" class="hidden">
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
          <!-- Multi-step Form -->
          <div class="step" id="step-1">
            <div class="p-5 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-800">Pengambilan Nomor Antrian</h2>
            </div>
            <form id="form-step-1" class="p-5">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Nama Pasien</label>
                <input type="text" name="nama_pasien" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Nama Pasien" required>
              </div>
              
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Jenis Pelayanan</label>
                <select name="jenis_pelayanan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                  <option value="BPJS">BPJS</option>
                  <option value="Umum">Umum</option>
                </select>
              </div>
              
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Poli Tujuan</label>
                <select name="poli_tujuan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                  <option value="Poli Umum">Poli Umum</option>
                  <option value="Poli Gigi">Poli Gigi</option>
                  <option value="Poli Anak">Poli Anak</option>
                </select>
              </div>
              
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Metode Kunjungan</label>
                <div class="flex flex-wrap gap-4">
                  <label class="inline-flex items-center">
                    <input type="radio" name="metode_kunjungan" value="Datang Langsung" class="h-4 w-4 text-green-600 focus:ring-green-500" checked>
                    <span class="ml-2 text-gray-700">Datang Langsung</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" name="metode_kunjungan" value="Rujukan" class="h-4 w-4 text-green-600 focus:ring-green-500">
                    <span class="ml-2 text-gray-700">Rujukan</span>
                  </label>
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                  <label class="block text-gray-700 text-sm font-medium mb-1">Tanggal Kunjungan</label>
                  <input type="date" name="tanggal_kunjungan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                  <label class="block text-gray-700 text-sm font-medium mb-1">Jam Kunjungan</label>
                  <input type="time" name="jam_kunjungan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
              </div>
              
              <button type="button" class="next-step w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                Selanjutnya <i data-lucide="arrow-right" class="w-4 h-4 ml-2 inline"></i>
              </button>
            </form>
          </div>
          
          <!-- Step 2 -->
          <div class="step hidden" id="step-2">
            <div class="p-5 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-800">Pengecekan Administrasi</h2>
            </div>
            <form id="form-step-2" class="p-5">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Nomor Kartu BPJS (Jika Ada)</label>
                <input type="text" name="nomor_bpjs" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Nomor Kartu BPJS">
              </div>
              
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">Status Administrasi</label>
                <select name="status_administrasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                  <option value="Diterima">Diterima</option>
                  <option value="Ditolak">Ditolak</option>
                </select>
              </div>
              
              <div class="flex justify-between">
                <button type="button" class="prev-step bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </button>
                <button type="button" class="next-step bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  Selanjutnya <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </button>
              </div>
            </form>
          </div>
          
          <!-- Step 3 -->
          <div class="step hidden" id="step-3">
            <div class="p-5 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-800">Pengambilan Tensi</h2>
            </div>
            <form id="form-step-3" class="p-5">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Tekanan Darah</label>
                <input type="text" name="tekanan_darah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: 120/80" required>
              </div>
              
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">Denyut Nadi</label>
                <input type="number" name="denyut_nadi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Denyut Nadi" required>
              </div>
              
              <div class="flex justify-between">
                <button type="button" class="prev-step bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </button>
                <button type="button" class="next-step bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  Selanjutnya <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </button>
              </div>
            </form>
          </div>
          
          <!-- Step 4 -->
          <div class="step hidden" id="step-4">
            <div class="p-5 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-800">Wawancara Penyakit</h2>
            </div>
            <form id="form-step-4" class="p-5">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Keluhan Utama</label>
                <textarea name="keluhan_utama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Jelaskan keluhan utama pasien" required></textarea>
              </div>
              
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Riwayat Penyakit</label>
                <textarea name="riwayat_penyakit" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Masukkan riwayat penyakit" required></textarea>
              </div>
              
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">Riwayat Alergi</label>
                <textarea name="riwayat_alergi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Masukkan riwayat alergi (jika ada)"></textarea>
              </div>
              
              <div class="flex justify-between">
                <button type="button" class="prev-step bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </button>
                <button type="button" class="next-step bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  Selanjutnya <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </button>
              </div>
            </form>
          </div>
          
          <!-- Step 5 -->
          <div class="step hidden" id="step-5">
            <div class="p-5 border-b border-gray-200">
              <h2 class="text-xl font-semibold text-gray-800">Pengarahan ke Dokter</h2>
            </div>
            <div class="p-5">
              <input type="hidden" name="status_pengiriman" value="Belum">
              <div id="reviewData" class="mb-6 p-4 bg-gray-50 rounded-md border border-gray-200">
                <!-- Review data will be inserted here -->
              </div>
              
              <div class="flex justify-between">
                <button type="button" class="prev-step bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </button>
                <button type="button" id="submitAdmin" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center">
                  <i data-lucide="send" class="w-4 h-4 mr-2"></i> Kirim Data ke Dokter
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      lucide.createIcons();
      
      // Sidebar Toggle
      const sidebar = document.getElementById('sidebar');
      const toggleButton = document.getElementById('toggleSidebar');
      const menuIcon = document.getElementById('menuIcon');
      const closeIcon = document.getElementById('closeIcon');
      
      toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
      });
      
      // Menu Navigation
      const dashboardContent = document.getElementById('dashboardContent');
      const administrasiContent = document.getElementById('administrasiContent');
      const headerTitle = document.getElementById('headerTitle');
      
      document.getElementById('menuDashboard').addEventListener('click', function(e) {
        e.preventDefault();
        setActiveMenu(this);
        dashboardContent.classList.remove('hidden');
        administrasiContent.classList.add('hidden');
        headerTitle.textContent = 'Dashboard Administrasi';
      });
      
      document.getElementById('menuAdministrasi').addEventListener('click', function(e) {
        e.preventDefault();
        setActiveMenu(this);
        administrasiContent.classList.remove('hidden');
        dashboardContent.classList.add('hidden');
        headerTitle.textContent = 'Administrasi Pasien';
        resetFormSteps();
      });
      
      function setActiveMenu(activeElement) {
        document.querySelectorAll('.menu-item').forEach(item => {
          item.classList.remove('bg-green-700');
        });
        activeElement.classList.add('bg-green-700');
      }
      
      function resetFormSteps() {
        document.querySelectorAll('.step').forEach((step, index) => {
          if (index === 0) {
            step.classList.remove('hidden');
          } else {
            step.classList.add('hidden');
          }
        });
        currentStep = 0;
      }
      
      // Multi-step Form Logic
      const steps = document.querySelectorAll('.step');
      let currentStep = 0;
      
      const nextButtons = document.querySelectorAll('.next-step');
      const prevButtons = document.querySelectorAll('.prev-step');
      
      nextButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          if (!validateStep(currentStep)) {
            alert("Harap lengkapi semua kolom yang wajib diisi!");
            return;
          }
          steps[currentStep].classList.add('hidden');
          currentStep++;
          steps[currentStep].classList.remove('hidden');
          if (currentStep === steps.length - 1) {
            showReview();
          }
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      });
      
      prevButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          steps[currentStep].classList.add('hidden');
          currentStep--;
          steps[currentStep].classList.remove('hidden');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      });
      
      function validateStep(stepIndex) {
        let isValid = true;
        const stepFields = document.querySelectorAll(`#step-${stepIndex + 1} [required]`);
        
        stepFields.forEach(field => {
          if (!field.value.trim()) {
            isValid = false;
            field.classList.add('border-red-500');
            // Add error message
            if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('text-red-500')) {
              const errorMsg = document.createElement('p');
              errorMsg.className = 'text-red-500 text-xs mt-1';
              errorMsg.textContent = 'Field ini wajib diisi';
              field.parentNode.insertBefore(errorMsg, field.nextSibling);
            }
          } else {
            field.classList.remove('border-red-500');
            // Remove error message if exists
            if (field.nextElementSibling && field.nextElementSibling.classList.contains('text-red-500')) {
              field.nextElementSibling.remove();
            }
          }
        });
        
        return isValid;
      }
      
      function showReview() {
        const formData = {};
        const forms = [
          document.getElementById('form-step-1'),
          document.getElementById('form-step-2'),
          document.getElementById('form-step-3'),
          document.getElementById('form-step-4')
        ];
        
        forms.forEach(form => {
          new FormData(form).forEach((value, key) => {
            formData[key] = value;
          });
        });
        
        const labels = {
          'nama_pasien': 'Nama Pasien',
          'jenis_pelayanan': 'Jenis Pelayanan',
          'poli_tujuan': 'Poli Tujuan',
          'metode_kunjungan': 'Metode Kunjungan',
          'tanggal_kunjungan': 'Tanggal Kunjungan',
          'jam_kunjungan': 'Jam Kunjungan',
          'nomor_bpjs': 'Nomor BPJS',
          'status_administrasi': 'Status Administrasi',
          'tekanan_darah': 'Tekanan Darah',
          'denyut_nadi': 'Denyut Nadi',
          'keluhan_utama': 'Keluhan Utama',
          'riwayat_penyakit': 'Riwayat Penyakit',
          'riwayat_alergi': 'Riwayat Alergi'
        };
        
        let reviewHTML = '<div class="space-y-3">';
        for (let key in formData) {
          if (formData[key]) {
            reviewHTML += `
              <div class="flex">
                <div class="w-1/3 font-medium text-gray-700">${labels[key] || key}:</div>
                <div class="w-2/3 text-gray-800">${formData[key]}</div>
              </div>
            `;
          }
        }
        reviewHTML += '</div>';
        document.getElementById('reviewData').innerHTML = reviewHTML;
      }
      
      // Form Submission
      document.getElementById('submitAdmin').addEventListener('click', function() {
        const formData = new FormData();
        const forms = [
          document.getElementById('form-step-1'),
          document.getElementById('form-step-2'),
          document.getElementById('form-step-3'),
          document.getElementById('form-step-4')
        ];
        
        forms.forEach(form => {
          new FormData(form).forEach((value, key) => {
            formData.append(key, value);
          });
        });
        
        formData.append('status_pengiriman', 'Belum');
        
        // Show loading state
        const submitBtn = document.getElementById('submitAdmin');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 mr-2 animate-spin"></i> Mengirim...';
        submitBtn.disabled = true;
        
        fetch('{{ route("pasien.store") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: formData,
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            // Show success notification
            alert('Administrasi Berhasil Terkirim Ke Dokter!');
            window.location.reload();
          } else {
            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert(error.message || 'Terjadi kesalahan saat mengirim data');
        })
        .finally(() => {
          submitBtn.innerHTML = originalText;
          submitBtn.disabled = false;
          lucide.createIcons(); 
        });
      });
      if (window.location.hash === '#administrasi') {
        document.getElementById('menuAdministrasi').click();
      }
    });
  </script>
</body>
</html>