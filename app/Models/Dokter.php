<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;
use League\CommonMark\Extension\Table\TableExtension;

class Dokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokters';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'NIP',
        'email',
        'password',
        'spesialis',
        'alamat',
        'jam_praktik',
        'tanggal_mendaftar',
        'foto',
    ];

    public function getNamaLengkapAttribute()
{
    return $this->nama_depan . ' ' . $this->nama_belakang;
}
    
}
