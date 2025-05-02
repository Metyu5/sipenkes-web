<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antrian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'antrian';

    protected $fillable = [
        'administrasi_id', 'nomor_antrian', 'jenis_pelayanan', 'status'
    ];
    protected $dates = ['deleted_at'];

    public function administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'administrasi_id');
    }
}
