<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'deskripsi',
        'ukuran',
        'berat',
        'spesifikasi',
        'gambar',
        'id_jenis'
    ];

    public $timestamps = false;
}
