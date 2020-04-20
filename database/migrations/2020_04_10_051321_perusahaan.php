<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Perusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis', function(Blueprint $table) {
            $table->id('id_jenis');
            $table->string('nama');
        });

        Schema::create('provinsi', function(Blueprint $table){
            $table->id('id_prov');
            $table->string('nama');
        });

        Schema::create('kabupaten', function(Blueprint $table) {
            $table->id('id_kab');
            $table->unsignedBigInteger('id_prov');
            $table->foreign('id_prov')->references('id_prov')->on('provinsi');
            $table->string('nama');
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis');
        });

        Schema::create('kecamatan', function(Blueprint $table) {
            $table->id('id_kec');
            $table->unsignedBigInteger('id_kab');
            $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
            $table->string('nama');
        });

        Schema::create('kelurahan', function(Blueprint $table) {
            $table->id('id_kel');
            $table->unsignedBigInteger('id_kec');
            $table->foreign('id_kec')->references('id_kec')->on('kecamatan');
            $table->string('nama');
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis');
        });

        Schema::create('perusahaan', function(Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->unsignedBigInteger('id_kab');
            $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('id_prov');
            $table->foreign('id_prov')->references('id_prov')->on('provinsi');
            $table->unsignedInteger('telp');
            $table->string('website');
            $table->string('no_akta_notaris');
            $table->string('npwp');
            $table->string('no_kemenkumham');
            $table->string('nik');
            $table->string('nama_wakil');
            $table->string('jabatan');
            $table->string('no_hp');
            $table->string('logo_perusahaan');
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('asos_id');
            $table->foreign('asos_id')->references('id')->on('asosiasi');
            $table->unsignedBigInteger('rayon_id');
            $table->foreign('rayon_id')->references('id')->on('data_rayon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis');
        Schema::dropIfExists('provinsi');
        Schema::dropIfExists('kabupaten');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kelurahan');
        Schema::dropIfExists('perusahaan');
    }
}
