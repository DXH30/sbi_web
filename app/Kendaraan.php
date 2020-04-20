<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'no',
        'merk',
        'ukuran',
        'berat',
        'spesifikasi',
        'gambar',
        'id_jenis'
    ];

    public $timestamps = false;
}
