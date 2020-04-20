<?php

use Illuminate\Database\Seeder;

class LettercodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lettercode_list = [
            ['lettercode' => 'AAA', 'lokasi' => 'Keterangan 1'],
            ['lettercode' => 'BBB', 'lokasi' => 'Keterangan 2'],
            ['lettercode' => 'CCC', 'lokasi' => 'Keterangan 3'],
            ['lettercode' => 'DDD', 'lokasi' => 'Keterangan 4']
        ];

        DB::table('lokasi')->insert($lettercode_list);
    }
}
