<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $fillable = [
        'id_kel',
        'id_kec',
        'nama',
        'id_jenis'
    ];
}
