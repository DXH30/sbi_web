<?php

use Illuminate\Database\Seeder;

class PelabuhanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pelabuhan')->delete();
        
        \DB::table('pelabuhan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode' => 'TPR',
                'nama' => 'Tanjung Perak',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-17 13:06:29',
                'updated_at' => '2020-06-17 13:06:29',
            ),
            1 => 
            array (
                'id' => 2,
                'kode' => 'TEST',
                'nama' => 'Nama Pelabuhan',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-19 07:28:40',
                'updated_at' => '2020-06-19 07:28:40',
            ),
        ));
        
        
    }
}