<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mode_transportasi', function(Blueprint $table) {
            $table->id();
            $table->string('mode');
        });

        Schema::create('jenis_kendaraan', function(Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->unsignedBigInteger('mode_id');
            $table->foreign('mode_id')->references('id')->on('mode_transportasi');
        });

        Schema::create('status_kendaraan', function(Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        Schema::create('kendaraan', function(Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->string('merk');
            $table->string('ukuran');
            $table->string('berat');
            $table->text('spesifikasi');
            $table->string('gambar');
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id')->on('jenis_kendaraan');
        });

        Schema::create('ketersediaan_kendaraan', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kendaraan');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            // $table->unsignedBigInteger('id_rayon');
            // $table->foreign('id_rayon')->references('id')->on('data_rayon');
            $table->unsignedBigInteger('id_letter');
            $table->foreign('id_letter')->references('id')->on('lokasi');
            $table->unsignedBigInteger('id_status');
            $table->foreign('id_status')->references('id')->on('status_kendaraan');
            $table->unsignedBigInteger('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ketersediaan_kendaraan');
        Schema::dropIfExists('kendaraan');
        Schema::dropIfExists('jenis_kendaraan');
        Schema::dropIfExists('status_kendaraan');
        Schema::dropIfExists('mode_transportasi');
    }
}
