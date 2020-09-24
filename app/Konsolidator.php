<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsolidator extends Model
{
    //
    protected $table = 'konsolidator';
    protected $fillable = ['user_id', 'bandara', 'harga_kg', 'alamat', 'kab_id', 'kel_id', 'kec_id', 'kode_pos', 'contact_person', 'no_hp'];
}
