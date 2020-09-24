<?php

use Illuminate\Database\Seeder;

class LokasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lokasi')->delete();
        
        \DB::table('lokasi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lettercode' => 'AAA',
                'lokasi' => 'Keterangan 1',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'lettercode' => 'BBB',
                'lokasi' => 'Keterangan 2',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'lettercode' => 'CCC',
                'lokasi' => 'Keterangan 3',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'lettercode' => 'DDD',
                'lokasi' => 'Keterangan 4',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'lettercode' => 'TEST',
                'lokasi' => 'Percobaan',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'lettercode' => 'CCCCC',
                'lokasi' => 'TESTBARU',
                'gps_lat' => NULL,
                'gps_long' => NULL,
            ),
        ));
        
        
    }
}