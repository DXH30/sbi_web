<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $fillable = [
        'id',
        'lettercode',
        'lokasi'
    ];

    public $timestamps = false;
}
