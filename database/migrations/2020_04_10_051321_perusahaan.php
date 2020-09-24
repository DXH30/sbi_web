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
        
        Schema::create('perusahaan', function(Blueprint $table) {
            $table->id();
            $table->string('noanggota')->nullable();
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten')->onDelete('cascade');
            $table->unsignedBigInteger('prov_id');
            $table->foreign('prov_id')->references('id_prov')->on('provinsi')->onDelet('cascade');
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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('asos_id')->nullable();
            $table->foreign('asos_id')->references('id')->on('asosiasi')->onDelete('cascade');
            $table->unsignedBigInteger('rayon_id')->nullable();
            $table->foreign('rayon_id')->references('id')->on('data_rayon')->onDelete('cascade');
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
