<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bandara extends Model
{
    protected $table = 'bandara';

    protected $fillable = [
      'kode',
      'nama',
      'id_kab',
      'id_prov',
      'status'
    ];
}
