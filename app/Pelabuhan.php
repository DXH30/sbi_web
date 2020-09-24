<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelabuhan extends Model
{
    //
    protected $table = 'pelabuhan';

    protected $fillable = [
      'kode',
      'nama',
      'id_kab',
      'id_prov',
      'status'
    ];
}
