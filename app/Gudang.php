<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    //
    protected $table = 'gudang';
    protected $fillable = ['user_id', 'alamat', 'kab_id', 'kec_id', 'kel_id', 'kode_pos', 'jenis', 'deskripsi', 'kapasitas', 'fasilitas', 'sewa', 'foto_gudang', 'size_pallet', 'created_at', 'updated_at'];
}
