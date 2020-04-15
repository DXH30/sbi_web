<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeTransportasi extends Model
{
    protected $table = 'mode_transportasi';
    protected $fillable = [
        'id',
        'mode'
    ];

    public $timestamps = false;
}
