<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KetersediaanKendaraan extends Model
{
    protected $table = 'ketersediaan_kendaraan';
    protected $fillable = [
        'id',
        'id_kendaraan',
        'id_user',
        'id_letter',
        'jumlah'
    ];

    public $timestamps = false;
}
