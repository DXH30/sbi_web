<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = 'professional';
    protected $fillable = [
        'nama',
        'email',
        'keahlian',
        'alamat',
        'rtrw',
        'id_kel',
        'id_kec',
        'id_kab',
        'id_prov',
        'kode_pos',
        'npwp',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'nama_perusahaan',
        'email_perusahaan',
        'foto',
        'foto_ktp'
    ];
}
