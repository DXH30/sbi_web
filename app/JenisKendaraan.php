<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
    protected $table = 'jenis_kendaraan';
    protected $fillable = [
        'id',
        'jenis',
        'mode_id'
    ];

    public $timestamps = false;
}
