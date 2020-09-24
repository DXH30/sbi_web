<?php

use App\Lettercode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(JenisTableSeeder::class);
        $this->call(ProvinsiTableSeeder::class);
        $this->call(KabupatenTableSeeder::class);
        $this->call(KecamatanTableSeeder::class);
        $this->call(KelurahanTableSeeder::class);
        $this->call(RayonSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(LettercodeSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(KodePosTableSeeder::class);
        $this->call(BandaraTableSeeder::class);
        $this->call(PelabuhanTableSeeder::class);
        $this->call(StasiunTableSeeder::class);
        $this->call(TerminalTableSeeder::class);
        $this->call(LokasiTableSeeder::class);
        $this->call(ModeTransportasiTableSeeder::class);
        $this->call(JenisKendaraanTableSeeder::class);
        $this->call(KendaraanTableSeeder::class);
        $this->call(KetersediaanKendaraanTableSeeder::class);
    }
}
