<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsulBarang extends Model
{
    //
    protected $table = 'consul_barang';
    protected $fillable = ['user_id', 'asal_kota_id', 'tujuan_kota_id', 'type_truck_id', 'sisa_load', 'tanggal', 'jenis_barang'];
}
