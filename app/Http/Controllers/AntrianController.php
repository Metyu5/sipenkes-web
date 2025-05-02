<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Administrasi;

class AntrianController extends Controller
{
    public function getAntrian()
    {
        $today = now()->toDateString();

        $totalAntrian = Antrian::whereDate('created_at', $today)->count();
        $pasienBPJS = Antrian::whereHas('administrasi', function ($query) {
            $query->where('jenis_pelayanan', 'BPJS');
        })->whereDate('created_at', $today)->count();

        $pasienUmum = Antrian::whereHas('administrasi', function ($query) {
            $query->where('jenis_pelayanan', 'Umum');
        })->whereDate('created_at', $today)->count();

        $antrianTerbaru = Antrian::with('administrasi:id,nama_pasien,jenis_pelayanan')
            ->latest()
            ->get();
        if (request()->routeIs('administrasi.dashboard')) {
            return view('administrasi.dashboard', compact('totalAntrian', 'pasienBPJS', 'pasienUmum', 'antrianTerbaru'));
        } elseif (request()->routeIs('dokter.dashboard')) {
            return view('dokters.dokter', compact('antrianTerbaru'));
        }

        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $administrasi = Administrasi::findOrFail($request->administrasi_id);

        $antrian = Antrian::create([
            'administrasi_id' => $request->administrasi_id,
            'nomor_antrian' => $request->nomor_antrian,
            'jenis_pelayanan' => $request->jenis_pelayanan,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('dashboard')->with('success', 'Antrian berhasil ditambahkan.');
    }

    public function dokterAntrian()
    {
        $today = now()->toDateString();
        $antrianTerbaru = Antrian::whereDate('created_at', $today)->latest()->get();


        return view('dokters.dokter', compact('antrianTerbaru'));
    }

    public function detail($id)
    {
        $antrian = Antrian::with('administrasi')->findOrFail($id);
        return view('antrian.detail', compact('antrian'));
    }

    public function index(Request $request)
    {
        $filterTanggal = $request->input('tanggal', now()->toDateString());
        $antrianTerbaru = Antrian::whereDate('created_at', $filterTanggal)
            ->latest()
            ->get();

        $totalAntrian = Antrian::whereDate('created_at', $filterTanggal)->count();

        return view('antrian.daftarantrian', compact('antrianTerbaru', 'totalAntrian', 'filterTanggal'));
    }

    public function dashboard()
    {
        return view('administrasi.dashboard');
    }
    public function getDetail($id)
    {
        $antrian = Antrian::with('administrasi')->findOrFail($id);
        return response()->json($antrian);
    }
    public function proses($nomor_antrian)
    {
        $antrian = Antrian::where('nomor_antrian', $nomor_antrian)->first();

        if ($antrian) {
            $antrian->status = 'Diproses';
            $antrian->save();

            return redirect()->back()->with('success', 'Status antrian berhasil diubah menjadi Diproses.');
        }

        return redirect()->back()->with('error', 'Antrian tidak ditemukan.');
    }
    public function selesai($nomor_antrian)
    {
        $antrian = Antrian::where('nomor_antrian', $nomor_antrian)->first();

        if ($antrian && $antrian->status == 'Diproses') {
            $antrian->status = 'Selesai';
            $antrian->save();
        }

        return redirect()->route('dokters.dokter')->with('success', 'Status antrian telah diubah menjadi Selesai');
    }
}
