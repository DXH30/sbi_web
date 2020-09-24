<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoorToDoor extends Model
{
    //
    protected $table = 'door_to_door';
    protected $fillable = ['user_id', 'asal_kota_id', 'tujuan_kota_id', 'harga', 'administrasi', 'minimal', 'jenis_barang'];
}
