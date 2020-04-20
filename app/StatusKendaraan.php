<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKendaraan extends Model
{
    protected $table = 'status_kendaraan';
    protected $fillable = [
        'id',
        'status'
    ];

    public $timestamps = false;
}
