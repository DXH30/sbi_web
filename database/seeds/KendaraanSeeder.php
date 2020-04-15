<?php

use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode_transportasi = [
            ['mode' => 'darat'],
            ['mode' => 'laut'],
            ['mode' => 'udara']
        ];

        DB::table('mode_transportasi')->insert($mode_transportasi);

        $jenis_kendaraan = [
            ['jenis' => 'bus', 'mode_id' => 1 ],
            ['jenis' => 'truk', 'mode_id' => 1 ],
        ];

        DB::table('jenis_kendaraan')->insert($jenis_kendaraan);

        $list_kendaraan = [
            ['no' => 'A01', 'merk' => 'Satu', 'ukuran' => '1234', 'berat_kosong' => '100', 'berat_max' => '200', 'model_mesin' => '3A', 'kap_silinder' => 'Test', 'kecepatan_max' => '100', 'tenaga_max' => '200', 'gambar' => '123.jpg', 'id_jenis' => '1' ],
            ['no' => 'A02', 'merk' => 'Satu', 'ukuran' => '1234', 'berat_kosong' => '100', 'berat_max' => '200', 'model_mesin' => '3A', 'kap_silinder' => 'Test', 'kecepatan_max' => '100', 'tenaga_max' => '200', 'gambar' => '123.jpg', 'id_jenis' => '1' ],
            ['no' => 'A03', 'merk' => 'Satu', 'ukuran' => '1234', 'berat_kosong' => '100', 'berat_max' => '200', 'model_mesin' => '3A', 'kap_silinder' => 'Test', 'kecepatan_max' => '100', 'tenaga_max' => '200', 'gambar' => '123.jpg', 'id_jenis' => '1' ]
        ];
        DB::table('kendaraan')->insert($list_kendaraan);
    }
}
