<?php

namespace App\Http\Controllers;
use App\Models\ResepDokter;

use App\Models\DataApoteker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ApotekerController extends Controller
{
    public function index()
    {
        // Menghitung jumlah resep yang masuk
        $resepMasuk = ResepDokter::whereDate('created_at', Carbon::today())->count(); 
        $resepList = ResepDokter::with(['dokter', 'administrasi'])
        ->whereDate('tanggal_resep', Carbon::today())
        ->get();


        return view('apoteker.dashboard', compact('resepMasuk', 'resepList'));
    }
    public function registerApoteker(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'NIP' => 'required|string|max:50|unique:data_apotekers,NIP',
            'email' => 'required|email|max:255|unique:data_apotekers,email',
            'password' => 'required|string|min:8|confirmed',
            'tanggal_mendaftar' => 'required|date',
            'foto' => 'required|image|max:2048', // Maks 2MB
        ]);

        try {
            // Hash password
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Upload foto
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('apotekers', 'public');
            } else {
                return redirect()->back()->withErrors(['foto' => 'Foto wajib diunggah.']);
            }

            // Simpan data
            DataApoteker::create([
                'nama_depan' => $validatedData['nama_depan'],
                'nama_belakang' => $validatedData['nama_belakang'],
                'NIP' => $validatedData['NIP'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'tanggal_mendaftar' => $validatedData['tanggal_mendaftar'],
                'foto' => $fotoPath,
            ]);

            return redirect()->back()->with('success', 'Akun apoteker berhasil dibuat.');
            
        } catch (\Exception $e) {
            Log::error('Error pendaftaran apoteker: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }
}
