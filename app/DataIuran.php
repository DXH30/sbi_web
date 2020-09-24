<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataIuran extends Model
{
    //
    protected $table = 'data_iuran';
    protected $fillable = ['asos_id', 'iuran_id', 'user_id', 'terkonfirmasi', 'created_at', 'updated_at', 'bukti_pembayaran'];
}
