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

        $ukuran_karoseri = [
            'tipe' => 'a01',
            'panjang' => '5',
            'lebar' => '4',
            'tinggi' => '1',
            'dalam' => '4',
        ];

        $ukuran_mobil = [
            'panjang' => '13',
            'lebar' => '2',
            'tinggi' => '4',
        ];

        $deskripsi = json_encode([
            'deskripsi' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, nostrum?",
            'no' => "A213",
            'Merk' => "Toyota"
        ]);

        $ukuran = json_encode([
            'ukuran_karoseri' => $ukuran_karoseri,
            'ukuran_mobil' => $ukuran_mobil
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
                'deskripsi' => $deskripsi,
                'ukuran' => $ukuran,
                'berat' => $berat,
                'spesifikasi' => $spesifikasi,
                'gambar' => '123.jpg',
                'id_jenis' => '1'
            ],
            [
                'deskripsi' => $deskripsi,
                'ukuran' => $ukuran,
                'berat' => $berat,
                'spesifikasi' => $spesifikasi,
                'gambar' => '123.jpg',
                'id_jenis' => '2'
            ],
            [
                'deskripsi' => $deskripsi,
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
