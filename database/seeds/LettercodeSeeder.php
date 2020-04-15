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
            ['code' => 'AAA', 'keterangan' => 'Keterangan 1'],
            ['code' => 'BBB', 'keterangan' => 'Keterangan 2'],
            ['code' => 'CCC', 'keterangan' => 'Keterangan 3'],
            ['code' => 'DDD', 'keterangan' => 'Keterangan 4']
        ];

        DB::table('lettercode')->insert($lettercode_list);
    }
}
