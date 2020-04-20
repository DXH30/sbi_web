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

        $status_kendaraan = [
            ['status' => 'Milik Sendiri'],
            ['status' => 'Join Partner']
        ];

        DB::table('status_kendaraan')->insert($status_kendaraan);
        $ukuran = json_encode([
            'ukuran_karoseri' => '100',
            'ukuran_mobil' => '200'
        ]);

        $berat = json_encode([
            'berat_kosong' => '20',
            'berat_max' => '100'
        ]);

        $spesifikasi = json_encode([
            'model_mesin' => 'Rotary',
            'kap_silinder' => 'Boxer',
            'kecepatan_max' => '160',
            'tenaga_max' => '90hp',
        ]);

        $list_kendaraan = [
            [
                'no' => 'A01',
                'merk' => 'Satu',
                'ukuran' => $ukuran,
                'berat' => $berat,
                'spesifikasi' => $spesifikasi,
                'gambar' => '123.jpg',
                'id_jenis' => '1'
            ],
            [
                'no' => 'A02',
                'merk' => 'Dua',
                'ukuran' => $ukuran,
                'berat' => $berat,
                'spesifikasi' => $spesifikasi,
                'gambar' => '123.jpg',
                'id_jenis' => '2'
            ],
            [
                'no' => 'A03',
                'merk' => 'Tiga',
                'ukuran' => $ukuran,
                'berat' => $berat,
                'spesifikasi' => $spesifikasi,
                'gambar' => '123.jpg',
                'id_jenis' => '1'
            ],
        ];
        DB::table('kendaraan')->insert($list_kendaraan);
    }
}
