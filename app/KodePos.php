<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodePos extends Model
{
    //
    protected $table = 'kode_pos';

    protected $fillable = [
      'kode',
      'id_kel',
      'id_kec',
      'id_kab',
      'id_prov',
      'status'
    ];
}
