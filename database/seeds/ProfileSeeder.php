<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = [
            'user_id' => '1',
            'nama' => 'Admin Baru',
            'no_telp' => '089089089089'
        ];
        DB::table('admin')->insert($admin);

        // Asosiasi
        $asosiasi = [
            'kat_id' => '1',
            'nama' => 'Asosiasi Satu',
            'telp_kantor' => '0812345678',
            'alamat_kantor' => 'Jl. Raya',
            'prov_id' => 11, 
            'kab_id' => 1101,
            'kode_pos' => '1234',
            'website' => 'example.com',
            'no_akta_notaris' => 'A1114',
            'no_kemenkumham' => 'BC1231',
            'nama_wakil' => 'Abdul Wakil',
            'jabatan' => 'Direktur',
            'npwp' => '999000999',
            'ketua_umum' => 'Ketua Satu',
            'nik_ketum' => '123123123123',
            'no_hp' => '09009088012',
            'logo_asosiasi' => 'ass_1.png',
            'user_id' => '2',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];

        DB::table('asosiasi')->insert($asosiasi);

        $data_rayon_list = [
            ['id_rayon' => 1, 'id_asos' => 1, 'wilayah' => 'Sidoarjo'],
            ['id_rayon' => 2, 'id_asos' => 1, 'wilayah' => 'Bandung'],
            ['id_rayon' => 3, 'id_asos' => 1, 'wilayah' => 'Jakarta']
        ];
        DB::table('data_rayon')->insert($data_rayon_list);

        // Perusahaan terverifikasi
        $perusahaan = [
            'nama' => 'Perusahaan Satu',
            'email' => 'abc@def.com',
            'alamat' => 'jalan',
            'prov_id' => '11',
            'kab_id' => '1101',
            'telp' => '829301234',
            'website' => 'website.com',
            'no_akta_notaris' => 'a0123',
            'npwp' => '123123123123',
            'no_kemenkumham' => 'A12312',
            'nik' => '51232145512',
            'nama_wakil' => 'Wakil',
            'jabatan' => 'Direktur',
            'no_hp' => '08123124',
            'logo_perusahaan' => 'per_1.png',
            'user_id' => '3',
            #            'asos_id' => '1',
            #            'rayon_id' => '1',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];
        DB::table('perusahaan')->insert($perusahaan);

        // Perusahaan tidak terverifikasi
    }
}
