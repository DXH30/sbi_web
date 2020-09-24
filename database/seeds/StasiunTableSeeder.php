<?php

use Illuminate\Database\Seeder;

class StasiunTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stasiun')->delete();
        
        \DB::table('stasiun')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode' => 'MJK',
                'nama' => 'Stasiun Mojokerto',
                'id_kab' => 3516,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-17 13:07:05',
                'updated_at' => '2020-06-17 13:07:05',
            ),
            1 => 
            array (
                'id' => 2,
                'kode' => 'GBG',
                'nama' => 'Stasiun Gubeng',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-19 07:30:26',
                'updated_at' => '2020-06-19 07:30:26',
            ),
        ));
        
        
    }
}