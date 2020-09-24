<?php

use Illuminate\Database\Seeder;

class KodePosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kode_pos')->delete();
        
        \DB::table('kode_pos')->insert(array (
            0 => 
            array (
                'id' => 2,
                'kode' => '33301',
                'id_kel' => 3172031005,
                'id_kec' => 317203,
                'id_kab' => 3172,
                'id_prov' => 31,
                'created_at' => '2020-06-18 08:01:11',
                'updated_at' => '2020-06-18 08:01:11',
            ),
        ));
        
        
    }
}