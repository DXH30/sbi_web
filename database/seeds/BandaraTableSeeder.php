<?php

use Illuminate\Database\Seeder;

class BandaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bandara')->delete();
        
        \DB::table('bandara')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode' => 'JND',
                'nama' => 'Bandara Juanda',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-17 13:05:15',
                'updated_at' => '2020-06-17 13:05:15',
            ),
            1 => 
            array (
                'id' => 2,
                'kode' => 'CGK',
                'nama' => 'Bandara Soekarno Hatta',
                'id_kab' => 3171,
                'id_prov' => 31,
                'status' => 'Aktif',
                'created_at' => '2020-06-17 13:05:52',
                'updated_at' => '2020-06-17 13:05:52',
            ),
            2 => 
            array (
                'id' => 3,
                'kode' => 'SUB',
                'nama' => 'Bandara Juanda',
                'id_kab' => 3515,
                'id_prov' => 35,
                'status' => 'Domestik',
                'created_at' => '2020-06-19 07:26:44',
                'updated_at' => '2020-06-23 06:08:51',
            ),
            3 => 
            array (
                'id' => 4,
                'kode' => 'COBA',
                'nama' => 'Bandara Coba',
                'id_kab' => 3673,
                'id_prov' => 36,
                'status' => 'Aktif',
                'created_at' => '2020-06-23 04:15:51',
                'updated_at' => '2020-06-23 04:15:51',
            ),
        ));
        
        
    }
}