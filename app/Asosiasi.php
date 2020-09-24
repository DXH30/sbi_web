<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asosiasi extends Model
{
    protected $table = 'asosiasi';
    protected $fillable = [
        'id', 'nama', 'telp_kantor', 'npwp', 'ketua_umum', 'nik_ketum', 'no_hp', 'logo_asosiasi', 'user_id', 'nib', 'nama_kbli', 'kode_kbli', 'no_akta_notaris', 'file_akte', 'file_npwp', 'file_kemen', 'file_domisili', 'file_ktp', 'file_struktur'
    ];
}
