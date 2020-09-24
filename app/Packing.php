<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    //
    protected $table = 'packing';
    protected $fillable = ['bandara', 'airwaybill', 'administrasi', 'dus_rapping', 'kayu_dus_rapping', 'alamat', 'kab_id', 'contact_person', 'no_hp'];
}
