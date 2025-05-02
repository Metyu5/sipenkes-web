<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResepDokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'resep_dokter'; 

    protected $fillable = [
        'dokter_id',
        'administrasi_id',
        'tanggal_resep',
        'nama_obat',
        'dosis',
        'jumlah',
        'keterangan',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function administrasi()
    {
        return $this->belongsTo(Administrasi::class);
    }
    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'administrasi_id', 'administrasi_id');
    }
}
