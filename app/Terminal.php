<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    //
    protected $table = 'terminal';

    protected $fillable = [
      'kode',
      'nama',
      'id_kab',
      'id_prov',
      'status'
    ];
}
