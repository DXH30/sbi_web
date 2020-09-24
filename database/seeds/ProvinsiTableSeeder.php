<?php

use Illuminate\Database\Seeder;

class ProvinsiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinsi')->delete();
        
        \DB::table('provinsi')->insert(array (
            0 => 
            array (
                'id_prov' => 11,
                'nama' => 'Aceh',
            ),
            1 => 
            array (
                'id_prov' => 12,
                'nama' => 'Sumatera Utara',
            ),
            2 => 
            array (
                'id_prov' => 13,
                'nama' => 'Sumatera Barat',
            ),
            3 => 
            array (
                'id_prov' => 14,
                'nama' => 'Riau',
            ),
            4 => 
            array (
                'id_prov' => 15,
                'nama' => 'Jambi',
            ),
            5 => 
            array (
                'id_prov' => 16,
                'nama' => 'Sumatera Selatan',
            ),
            6 => 
            array (
                'id_prov' => 17,
                'nama' => 'Bengkulu',
            ),
            7 => 
            array (
                'id_prov' => 18,
                'nama' => 'Lampung',
            ),
            8 => 
            array (
                'id_prov' => 19,
                'nama' => 'Kepulauan Bangka Belitung',
            ),
            9 => 
            array (
                'id_prov' => 21,
                'nama' => 'Kepulauan Riau',
            ),
            10 => 
            array (
                'id_prov' => 31,
                'nama' => 'DKI Jakarta',
            ),
            11 => 
            array (
                'id_prov' => 32,
                'nama' => 'Jawa Barat',
            ),
            12 => 
            array (
                'id_prov' => 33,
                'nama' => 'Jawa Tengah',
            ),
            13 => 
            array (
                'id_prov' => 34,
                'nama' => 'DI Yogyakarta',
            ),
            14 => 
            array (
                'id_prov' => 35,
                'nama' => 'Jawa Timur',
            ),
            15 => 
            array (
                'id_prov' => 36,
                'nama' => 'Banten',
            ),
            16 => 
            array (
                'id_prov' => 51,
                'nama' => 'Bali',
            ),
            17 => 
            array (
                'id_prov' => 52,
                'nama' => 'Nusa Tenggara Barat',
            ),
            18 => 
            array (
                'id_prov' => 53,
                'nama' => 'Nusa Tenggara Timur',
            ),
            19 => 
            array (
                'id_prov' => 61,
                'nama' => 'Kalimantan Barat',
            ),
            20 => 
            array (
                'id_prov' => 62,
                'nama' => 'Kalimantan Tengah',
            ),
            21 => 
            array (
                'id_prov' => 63,
                'nama' => 'Kalimantan Selatan',
            ),
            22 => 
            array (
                'id_prov' => 64,
                'nama' => 'Kalimantan Timur',
            ),
            23 => 
            array (
                'id_prov' => 65,
                'nama' => 'Kalimantan Utara',
            ),
            24 => 
            array (
                'id_prov' => 71,
                'nama' => 'Sulawesi Utara',
            ),
            25 => 
            array (
                'id_prov' => 72,
                'nama' => 'Sulawesi Tengah',
            ),
            26 => 
            array (
                'id_prov' => 73,
                'nama' => 'Sulawesi Selatan',
            ),
            27 => 
            array (
                'id_prov' => 74,
                'nama' => 'Sulawesi Tenggara',
            ),
            28 => 
            array (
                'id_prov' => 75,
                'nama' => 'Gorontalo',
            ),
            29 => 
            array (
                'id_prov' => 76,
                'nama' => 'Sulawesi Barat',
            ),
            30 => 
            array (
                'id_prov' => 81,
                'nama' => 'Maluku',
            ),
            31 => 
            array (
                'id_prov' => 82,
                'nama' => 'Maluku Utara',
            ),
            32 => 
            array (
                'id_prov' => 91,
                'nama' => 'Papua Barat',
            ),
            33 => 
            array (
                'id_prov' => 92,
                'nama' => 'Papua',
            ),
        ));
        
        
    }
}