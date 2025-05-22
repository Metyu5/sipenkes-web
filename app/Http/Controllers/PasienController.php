<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_pasien'       => 'required|string|max:255',
            'jenis_pelayanan'   => 'required|in:BPJS,Umum',
            'poli_tujuan'       => 'required|string|max:255',
            'metode_kunjungan'  => 'required|in:Datang Langsung,Rujukan',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan'     => 'required',
            'nomor_bpjs'        => 'nullable|string|max:255',
            'status_administrasi' => 'required|in:Diterima,Ditolak',
            'tekanan_darah'     => 'nullable|string|max:255',
            'denyut_nadi'       => 'nullable|integer',
            'bb'                => 'nullable|numeric|min:0|max:300',
            'tb'                => 'nullable|numeric|min:0|max:300',
            'keluhan_utama'     => 'nullable|string',
            'riwayat_penyakit'  => 'nullable|string',
            'riwayat_alergi'    => 'nullable|string',
        ]);

        // Nomor antrian akan di-generate otomatis di model
        Administrasi::create($validatedData);

        return response()->json([
         'success' => true,
            'message' => 'Data administrasi berhasil disimpan',
]);

    }
}
