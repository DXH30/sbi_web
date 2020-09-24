<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegulatedAgent extends Model
{
    //
    protected $table = 'regulated_agent';
    protected $fillable = ['user_id', 'bandara', 'harga_kg', 'administrasi', 'alamat', 'kab_id', 'kec_id', 'kode_pos', 'contact_person', 'no_hp'];
}
