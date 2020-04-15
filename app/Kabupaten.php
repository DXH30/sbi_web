<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $fillable = [
        'id_kab',
        'id_prov',
        'nama',
        'id_jenis'
    ];
}
