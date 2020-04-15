<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $fillable = [
        'id',
        'nama_perusahaan',
        'email',
        'alamat',
        'kota_id',
        'provinsi_id'
    ];
}
