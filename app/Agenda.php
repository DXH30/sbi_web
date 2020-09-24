<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = 'agenda';
    protected $fillable = ['id_rayon', 'wilayah', 'acara', 'waktu', 'tempat', 'contact_person', 'no_hp'];
}
