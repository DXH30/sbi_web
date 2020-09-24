<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'no_telp'
    ];

    public $timestamps = false;
}
