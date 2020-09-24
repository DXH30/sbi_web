<?php

use Illuminate\Database\Seeder;

class JenisKendaraanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kendaraan')->delete();
        
        \DB::table('jenis_kendaraan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'jenis' => 'bus',
                'mode_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'jenis' => 'truk',
                'mode_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'jenis' => 'kapal_laut',
                'mode_id' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'jenis' => 'pesawat',
                'mode_id' => 3,
            ),
            4 => 
            array (
                'id' => 5,
                'jenis' => 'kereta_api',
                'mode_id' => 4,
            ),
        ));
        
        
    }
}