<?php

use Illuminate\Database\Seeder;

class ModeTransportasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mode_transportasi')->delete();
        
        \DB::table('mode_transportasi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'mode' => 'DARAT',
            ),
            1 => 
            array (
                'id' => 2,
                'mode' => 'LAUT',
            ),
            2 => 
            array (
                'id' => 3,
                'mode' => 'UDARA',
            ),
            3 => 
            array (
                'id' => 4,
                'mode' => 'KERETA API',
            ),
        ));
        
        
    }
}