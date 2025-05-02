<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\Administrasi;
use App\Models\ResepDokter;


class DokterController extends Controller
{

    public function filterResep(Request $request)
    {
        $query = ResepDokter::with(['dokter', 'administrasi', 'antrian'])
        ->whereDate('tanggal_resep', Carbon::today());
    
        if ($request->filled('search')) {
            $query->whereHas('administrasi', function ($q) use ($request) {
                $q->where('nama_pasien', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('jenis_pelayanan')) {
            $query->whereHas('administrasi', function ($q) use ($request) {
                $q->where('jenis_pelayanan', $request->jenis_pelayanan);
            });
        }
    
        if ($request->filled('status_antrian')) {
            $query->whereHas('antrian', function ($q) use ($request) {
                $q->where('status', $request->status_antrian);
            });
        }
    
        // Return JSON agar bisa dibaca oleh JavaScript
        return response()->json($query->get());
    }

    public function index()
{
    $antrianTerbaru = Antrian::whereDate('created_at', Carbon::today())->get();
    $antrianDiprosesCount = Antrian::where('status', 'Selesai')->count();
    $PasienMasuk = Antrian::whereDate('created_at', Carbon::today())->count();
    $resepSelesai = ResepDokter::count();
    $dokters = Dokter::all(); 
    $pasienHariIni = Administrasi::whereDate('tanggal_kunjungan', now()->toDateString())
    ->whereHas('antrian', function ($query) {
        $query->where('status', '!=', 'Selesai');
    })
    ->get();


    // Tambahkan logika filter berdasarkan request
    $query = ResepDokter::with(['dokter', 'administrasi', 'antrian'])
    ->whereDate('tanggal_resep', Carbon::today());

    if (request('jenis_pelayanan')) {
        $query->whereHas('administrasi', function ($q) {
            $q->where('jenis_pelayanan', request('jenis_pelayanan'));
        });
    }

    if (request('status_antrian')) {
        $query->whereHas('antrian', function ($q) {
            $q->where('status', request('status_antrian'));
        });
    }
    if (request('search')) {
        $query->whereHas('administrasi', function ($q) {
            $q->where('nama_pasien', 'like', '%' . request('search') . '%');
        });
    }
    

    $resepDokter = $query->get(); // hasil resep yang difilter

    return view('dokters.dokter', compact(
        'antrianTerbaru',
        'antrianDiprosesCount',
        'PasienMasuk',
        'dokters',
        'pasienHariIni',
        'resepSelesai',
        'resepDokter',
    ));
}


    public function showDetail($nomor_antrian)
{
    $administrasi = Administrasi::where('nomor_antrian', $nomor_antrian)->first();
    
    if ($administrasi) {
        // Mengirim data administrasi ke halaman detail
        return view('dokters.detail', compact('administrasi'));
    } else {
        // Jika data tidak ditemukan
        return redirect()->route('dokters.dokter')->with('error', 'Administrasi tidak ditemukan.');
    }
}

    public function registerDokter(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'NIP' => 'required|string|max:50|unique:dokters,NIP',
            'email' => 'required|email|max:255|unique:dokters,email',
            'password' => 'required|string|min:8|confirmed',
            'spesialis' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'jam_praktik' => 'required|string|max:100',
            'tanggal_mendaftar' => 'required|date',
            'foto' => 'required|image|max:2048', // Maks 2MB
        ]);
        // dd($validatedData);

        try {
            // Hash password
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Upload foto
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('dokters', 'public');
            } else {
                return redirect()->back()->withErrors(['foto' => 'Foto wajib diunggah.']);
            }
            // dd($validatedData);

            // Simpan data
            Dokter::create([
                'nama_depan' => $validatedData['nama_depan'],
                'nama_belakang' => $validatedData['nama_belakang'],
                'NIP' => $validatedData['NIP'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'spesialis' => $validatedData['spesialis'],
                'alamat' => $validatedData['alamat'],
                'jam_praktik' => $validatedData['jam_praktik'],
                'tanggal_mendaftar' => $validatedData['tanggal_mendaftar'],
                'foto' => $fotoPath,
            ]);
            // dd('Data berhasil disimpan!');

            return redirect()->back()->with('success', 'Akun dokter berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Error pendaftaran dokter: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }

        

        
    }
    
}
