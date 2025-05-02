import "./bootstrap";
import Alpine from "alpinejs";
import "animate.css";
import AOS from "aos";
import "aos/dist/aos.css";

import "keen-slider/keen-slider.min.css";
import "@fontsource/poppins";
import "@fortawesome/fontawesome-free/css/all.css";
import KeenSlider from "keen-slider";
import "keen-slider/keen-slider.min.css";
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import Swal from 'sweetalert2'; 
import "@fontsource/poppins/500.css"; // Medium
import "@fontsource/poppins/600.css"; // SemiBold
import "@fontsource/poppins/700.css"; // Bold

window.Alpine = Alpine;
Alpine.start();
document.addEventListener("DOMContentLoaded", function () {
    AOS.init();
});

document.addEventListener("DOMContentLoaded", function () {
    const keenSliderElement = document.querySelector("#keen-slider");
    const keenSliderActive = document.getElementById("keen-slider-active");
    const keenSliderCount = document.getElementById("keen-slider-count");

    if (keenSliderElement) {
        const keenSlider = new KeenSlider(keenSliderElement, {
            loop: true,
            defaultAnimation: {
                duration: 750,
            },
            slides: {
                origin: "center",
                perView: 1,
                spacing: 16,
            },
            breakpoints: {
                "(min-width: 640px)": {
                    slides: {
                        origin: "center",
                        perView: 1.5,
                        spacing: 16,
                    },
                },
                "(min-width: 768px)": {
                    slides: {
                        origin: "center",
                        perView: 1.75,
                        spacing: 16,
                    },
                },
                "(min-width: 1024px)": {
                    slides: {
                        origin: "center",
                        perView: 3,
                        spacing: 16,
                    },
                },
            },
            created(slider) {
                slider.slides[slider.track.details.rel].classList.remove(
                    "opacity-40"
                );

                keenSliderActive.innerText = slider.track.details.rel + 1;
                keenSliderCount.innerText = slider.slides.length;
            },
            slideChanged(slider) {
                slider.slides.forEach((slide) =>
                    slide.classList.add("opacity-40")
                );

                slider.slides[slider.track.details.rel].classList.remove(
                    "opacity-40"
                );

                keenSliderActive.innerText = slider.track.details.rel + 1;
            },
        });

        // Tombol Navigasi
        const keenSliderPrevious = document.getElementById(
            "keen-slider-previous"
        );
        const keenSliderNext = document.getElementById("keen-slider-next");

        if (keenSliderPrevious && keenSliderNext) {
            keenSliderPrevious.addEventListener("click", () =>
                keenSlider.prev()
            );
            keenSliderNext.addEventListener("click", () => keenSlider.next());
        }
    }
});

// leafletjs maps offline
document.addEventListener("DOMContentLoaded", function () {
  var map = L.map("map").setView([0.6409729, 122.5584132], 15); // Koordinat Puskesmas Paguyaman

  // Tile online (misalnya MapTiler atau OpenStreetMap)
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  L.marker([0.6409729, 122.5584132])
    .addTo(map)
    .bindPopup("Puskesmas Paguyaman")
    .openPopup();
});


// Dokter blade
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');

  
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    });


    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });


    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.dataset.section;

            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });

       
            document.getElementById(targetSection).classList.remove('hidden');

            document.querySelectorAll('.menu-item').forEach(menu => {
                menu.classList.remove('bg-green-700');
            });
            this.classList.add('bg-green-700');
        });
    });
    const formResep = document.querySelector("#buat-resep form"); 
    if (formResep) {
        formResep.addEventListener("submit", function (e) {
            e.preventDefault();
    
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dikirim ke apoteker!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    formResep.submit(); // submit manual
                }
            });
        });
    }

    function validateForm() {
      const fields = [
          { id: 'dokter_id', label: 'Nama Dokter Pemeriksa' },
          { id: 'administrasi_id', label: 'Nama Pasien' },
          { id: 'tanggal_resep', label: 'Tanggal Resep' },
          { id: 'nama_obat', label: 'Nama Obat' },
          { id: 'dosis', label: 'Dosis' },
          { id: 'jumlah', label: 'Jumlah' }
      ];

      for (let field of fields) {
          const value = document.getElementById(field.id).value;
          if (!value) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Data Belum Lengkap!',
                  text: `Field "${field.label}" wajib diisi.`,
                  confirmButtonColor: '#16a34a'
              });
              return false;
          }
      }

      return true;
  }
// Auto FIlter
// Fungsi untuk mengubah format tanggal (sesuaikan dengan kebutuhan)
function formatTanggal(tanggalStr) {
    const tanggal = new Date(tanggalStr);
    // Format tanggal misalnya: 08 Apr 2025
    return tanggal.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
  }
  
  function filterPatients() {
    const loadingIndicator = document.getElementById('loadingIndicator');
    loadingIndicator.style.display = 'block'; // Tampilkan loading
  
    const form = document.getElementById('filterForm');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
  
    fetch('/filter-resep?' + params.toString(), {
      method: 'GET',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
      const tbody = document.querySelector('#patientsTable tbody');
      tbody.innerHTML = ''; // Bersihkan isi tabel
  
      const bgColors = ['bg-blue-100', 'bg-purple-100', 'bg-green-100'];
      const textColors = ['text-blue-600', 'text-purple-600', 'text-green-600'];
  
      data.forEach(resep => {
        const kodeResep = resep.kode_resep ? resep.kode_resep : 'RESEP-' + resep.id;
        const inisial = resep.administrasi.nama_pasien.substring(0, 2).toUpperCase();
        const indexColor = resep.id % 3;
        const warnaBg = bgColors[indexColor];
        const warnaText = textColors[indexColor];
        const formattedTanggal = formatTanggal(resep.tanggal_resep);
        const status = resep.antrian && resep.antrian.status ? resep.antrian.status : 'Belum Ada';
        const statusClass = status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
  
        const tr = document.createElement('tr');
        tr.classList.add('hover:bg-gray-50', 'transition-colors');
  
        const tdResep = document.createElement('td');
        tdResep.classList.add('px-6', 'py-4', 'whitespace-nowrap');
        tdResep.innerHTML = `
          <div class="font-medium text-green-700">${kodeResep}</div>
          <div class="text-xs text-gray-500">ID: ${resep.id}</div>
        `;
  
        const tdPasien = document.createElement('td');
        tdPasien.classList.add('px-6', 'py-4');
        tdPasien.innerHTML = `
          <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10 rounded-full ${warnaBg} flex items-center justify-center mr-3">
              <span class="${warnaText} font-medium">${inisial}</span>
            </div>
            <div>
              <div class="font-medium">${resep.administrasi.nama_pasien}</div>
              <div class="text-xs text-gray-500">${resep.administrasi.jenis_pelayanan ? resep.administrasi.jenis_pelayanan : 'Umum'}</div>
            </div>
          </div>
        `;
  
        const tdDokter = document.createElement('td');
        tdDokter.classList.add('px-6', 'py-4');
        tdDokter.innerHTML = `
          <div class="text-sm font-medium">${resep.dokter.nama_depan} ${resep.dokter.nama_belakang}</div>
          <div class="text-xs text-gray-500">${resep.dokter.spesialis}</div>
        `;
  
        const tdTanggal = document.createElement('td');
        tdTanggal.classList.add('px-6', 'py-4', 'whitespace-nowrap');
        tdTanggal.innerHTML = `
          <div class="text-sm">${formattedTanggal}</div>
          <div class="text-xs text-gray-500">Resep ID: ${resep.id}</div>
        `;
  
        const tdObat = document.createElement('td');
        tdObat.classList.add('px-6', 'py-4');
        tdObat.innerHTML = `
          <div class="flex items-center">
            <div class="bg-green-100 p-1 rounded mr-2">
              <i class="fas fa-pills text-green-600 text-xs"></i>
            </div>
            <div>
              <div class="text-sm font-medium">${resep.nama_obat} (${resep.jumlah})</div>
              <div class="text-xs text-gray-500">Dosis: ${resep.dosis}</div>
              <div class="text-xs text-gray-500">${resep.keterangan}</div>
            </div>
          </div>
        `;
  
        const tdStatus = document.createElement('td');
        tdStatus.classList.add('px-6', 'py-4', 'whitespace-nowrap');
        tdStatus.innerHTML = `
          <span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass}">
            ${status}
          </span>
        `;
  
        tr.appendChild(tdResep);
        tr.appendChild(tdPasien);
        tr.appendChild(tdDokter);
        tr.appendChild(tdTanggal);
        tr.appendChild(tdObat);
        tr.appendChild(tdStatus);
  
        tbody.appendChild(tr);
      });
    })
    .catch(error => console.error('Error:', error))
    .finally(() => {
      loadingIndicator.style.display = 'none';
    });
  }
  
  document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
  });
  document.getElementById('filterForm').addEventListener('input', filterPatients);
  document.getElementById('filterForm').addEventListener('change', filterPatients);
  document.getElementById('filterButton').addEventListener('click', filterPatients);
  


});

  


