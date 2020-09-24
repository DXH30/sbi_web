<?php

use Illuminate\Database\Seeder;

class TerminalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('terminal')->delete();
        
        \DB::table('terminal')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode' => 'JBY',
                'nama' => 'Terminal Joyoboyo',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-17 13:07:48',
                'updated_at' => '2020-06-17 13:07:48',
            ),
            1 => 
            array (
                'id' => 2,
                'kode' => 'TEST',
                'nama' => 'Terminal Bungurasih',
                'id_kab' => 3578,
                'id_prov' => 35,
                'status' => 'Aktif',
                'created_at' => '2020-06-19 07:31:44',
                'updated_at' => '2020-06-19 07:31:44',
            ),
        ));
        
        
    }
}