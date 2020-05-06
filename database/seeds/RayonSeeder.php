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
            ['nama' => 'DPP (Dewan Pimpinan Pusat)'],
            ['nama' => 'DPW (Dewan Pimpinan Wilayah)'],
            ['nama' => 'DPC (Dewan Pimpinan Cabang)'],
            ['nama' => 'DPD (Dewan Pimpinan Daerah)']
        ];
        DB::table('rayon')->insert($rayon_list);
    }
}
