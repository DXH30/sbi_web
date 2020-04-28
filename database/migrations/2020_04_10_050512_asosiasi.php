<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asosiasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function(Blueprint $table) {
            $table->id();
            $table->string('nama');
        });

        Schema::create('rayon', function(Blueprint $table) {
            $table->id();
            $table->string('nama');
        });

        Schema::create('lokasi', function(Blueprint $table) {
            $table->id();
            $table->string('lettercode');
            $table->string('lokasi');
        });

        Schema::create('asosiasi', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kat_id');
            $table->foreign('kat_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('telp_kantor');
            $table->string('npwp');
            $table->string('ketua_umum');
            $table->string('nik_ketum');
            $table->string('no_hp');
            $table->string('logo_asosiasi');
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('data_rayon', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rayon');
            $table->foreign('id_rayon')->references('id')->on('rayon');
            $table->unsignedBigInteger('id_asos');
            $table->foreign('id_asos')->references('id')->on('asosiasi');
            $table->string('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_rayon');
        Schema::dropIfExists('asosiasi');
        Schema::dropIfExists('lettercode');
        Schema::dropIfExists('rayon');
        Schema::dropIfExists('kategori');
    }
}
