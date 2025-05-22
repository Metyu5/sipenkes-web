<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function simpanLaporan(Request $request)
    {
        // Validasi input
        $request->validate([
            'isi_laporan' => 'required|string',
        ]);

        // Simpan ke database
        Laporan::create([
            'isi_laporan' => $request->isi_laporan,
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim.');
    }

    public function dashboard()
    {
         $dokters = Dokter::all();  // ambil semua dokter
    return view('apoteker.dashboard', compact('dokters'));
    }
}
