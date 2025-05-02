<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('administrasi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_antrian')->unique();
            $table->string('nama_pasien');
            $table->enum('jenis_pelayanan', ['BPJS', 'Umum']);
            $table->string('poli_tujuan');
            $table->enum('metode_kunjungan', ['Datang Langsung', 'Rujukan']);
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->string('nomor_bpjs')->nullable();
            $table->enum('status_administrasi', ['Diterima', 'Ditolak']);
            $table->string('tekanan_darah')->nullable();
            $table->integer('denyut_nadi')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->enum('status_pengiriman', ['Belum', 'Sudah'])->default('Belum');
            $table->timestamps(); // Ini sudah menambahkan created_at dan updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi');
    }
};
