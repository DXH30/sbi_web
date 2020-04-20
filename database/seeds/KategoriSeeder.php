<?php

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori_list = [
            ['nama' => 'Supply Chain'],
            ['nama' => 'Demand'],
            ['nama' => 'Store']
        ];
        DB::table('kategori')->insert($kategori_list);
    }
}
