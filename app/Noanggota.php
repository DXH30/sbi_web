<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noanggota extends Model
{
    protected $table = 'nomor_anggota';
    protected $fillable = [
        'id', 'nomor' 
    ];

}
