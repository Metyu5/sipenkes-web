<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use App\Models\Antrian;
use Illuminate\Http\Request;

class ResepDokterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'dokter_id'        => 'required|exists:dokters,id', // Dokter harus ada di tabel dokters
            'administrasi_id'  => 'required|exists:administrasi,id', // Administrasi harus ada di tabel administrasi
            'tanggal_resep'    => 'required|date',
            'nama_obat'        => 'required|string',
            'dosis'            => 'required|string',
            'jumlah'           => 'required|integer',
            'keterangan'       => 'nullable|string',
        ]);

        Antrian::where('administrasi_id', $validated['administrasi_id'])
           ->where('status', 'Diproses')
           ->update(['status' => 'Selesai']);

        // Menyimpan data resep dokter ke dalam tabel resep_dokter
        ResepDokter::create([
            'dokter_id'        => $validated['dokter_id'],
            'administrasi_id'  => $validated['administrasi_id'],
            'tanggal_resep'    => $validated['tanggal_resep'],
            'nama_obat'        => $validated['nama_obat'],
            'dosis'            => $validated['dosis'],
            'jumlah'           => $validated['jumlah'],
            'keterangan'       => $validated['keterangan'] ?? null,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Resep berhasil disimpan!');
    }
}

