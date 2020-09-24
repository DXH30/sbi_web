<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportWarehouse extends Model
{
    //
    protected $table = 'airport_warehouse';
    protected $fillable = ['user_id', 'bandara', 'harga_kg', 'administrasi', 'alamat', 'kab_id', 'kec_id', 'kode_pos', 'contact_person', 'no_hp'];
}
