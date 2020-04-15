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
        'berat_kosong',
        'berat_max',
        'model_mesin',
        'kap_silinder',
        'kecepatan_max',
        'tenaga_max',
        'gambar',
        'id_jenis'
    ];

    public $timestamps = false;
}
