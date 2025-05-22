<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    protected $table = 'laporan';
    protected $fillable = [
        'dokter_id',
        'isi_laporan',
        'status',
    ];
    public function dokter () 
    {
        return $this->belongsTo(Dokter::class);
    }
}
