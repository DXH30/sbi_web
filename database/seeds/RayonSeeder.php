<?php

use Illuminate\Database\Seeder;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rayon_list = [
            ['nama' => 'Rayon 1'],
            ['nama' => 'Rayon 2'],
            ['nama' => 'Rayon 3']
        ];
        DB::table('rayon')->insert($rayon_list);
    }
}
