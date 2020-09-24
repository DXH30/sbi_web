<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    //
    protected $table = 'stasiun';

    protected $fillable = [
      'kode',
      'nama',
      'id_kab',
      'id_prov',
      'status'
    ];
}
