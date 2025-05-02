<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'administrasi';

    protected $fillable = [
        'nomor_antrian',
        'nama_pasien',
        'jenis_pelayanan',
        'poli_tujuan',
        'metode_kunjungan',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'nomor_bpjs',
        'status_administrasi',
        'tekanan_darah',
        'denyut_nadi',
        'keluhan_utama',
        'riwayat_penyakit',
        'riwayat_alergi',
        'status_pengiriman',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'administrasi_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($administrasi) {
            $lastId = self::withTrashed()->max('id') + 1;
            $administrasi->nomor_antrian = 'A' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        });

        static::created(function ($administrasi) {
            Antrian::create([
                'administrasi_id' => $administrasi->id,
                'nomor_antrian' => $administrasi->nomor_antrian,
                'jenis_pelayanan' => $administrasi->jenis_pelayanan, 
                'status' => 'Menunggu',
            ]);
        });
    }
}
