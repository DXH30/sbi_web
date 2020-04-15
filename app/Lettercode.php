<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lettercode extends Model
{
    protected $table = 'lettercode';
    protected $fillable = [
        'id',
        'code',
        'keterangan'
    ];

    public $timestamps = false;
}
