<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarAsosiasi extends Model
{
    //
    protected $table = 'daftar_asosiasi';
    protected $fillable = ['id', 'asos_id', 'user_id'];
}
