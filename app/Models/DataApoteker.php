<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class DataApoteker extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'NIP',
        'email',
        'password',
        'tanggal_mendaftar',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];
}   
