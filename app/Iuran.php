<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $table = 'iuran';
    protected $fillable = ['asos_id', 'waktu_mulai', 'waktu_selesai', 'harga_per_bulan', 'harga_per_tahun'];
}
