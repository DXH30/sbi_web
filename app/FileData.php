<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileData extends Model
{
    //
    protected $table = 'file_data';
    protected $fillable = [
     'id',
     'id_user',
     'nama_file',
     'keterangan',
     'level'
    ];
}
