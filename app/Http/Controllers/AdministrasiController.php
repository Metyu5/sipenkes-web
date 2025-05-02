<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAdministrasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class AdministrasiController extends Controller
{
    public function registerAdministrasi(Request $request)
    {
        try {
            // Validasi Data
            $request->validate([
                'nama_depan' => 'required|string|max:255',
                'nama_belakang' => 'required|string|max:255',
                'NIP' => 'required|numeric|digits_between:8,18|unique:data_administrasis,NIP',
                'email' => 'required|email|unique:data_administrasis,email',
                'password' => 'required|min:6|confirmed',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Simpan Foto
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('apotekers', 'public');
            } else {
                return redirect()->back()->withErrors(['foto' => 'Foto wajib diunggah.']);
            }

            // Simpan ke Database
            $data = DataAdministrasi::create([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'NIP' => $request->NIP,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tanggal_mendaftar' => now()->toDateString(),
                'foto' => $fotoPath,
            ]);

            return redirect()->back()->with('success', 'Akun berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Error pendaftaran apoteker: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }
}
