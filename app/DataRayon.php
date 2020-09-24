<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRayon extends Model
{
    protected $table = 'data_rayon';
    protected $fillable = [
        'id',
        'id_rayon',
        'id_asos',
        'wilayah',
        'default_password',
        'id_parent'
    ];
    public $timestamps = false;
}
