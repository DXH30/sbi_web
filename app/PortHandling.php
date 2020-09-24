<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortHandling extends Model
{
    //
    protected $table = 'port_handling';
    protected $fillable = ['user_id', 'kab_id', 'kel_id', 'kec_id', 'kode_pos', 'bandara', 'minimal_kg', 'estimasi_hari', 'harga_kg'];
}
