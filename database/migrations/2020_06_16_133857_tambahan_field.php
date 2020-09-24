<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahanField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bandara', function(Blueprint $table) {
          $table->id();
          $table->string('kode');
          $table->string('nama');
          $table->unsignedBigInteger('id_kab');
          $table->foreign('id_kab')->references('id_kab')->on('kabupaten')->onDelete('cascade');
          $table->unsignedBigInteger('id_prov');
          $table->foreign('id_prov')->references('id_prov')->on('provinsi')->onDelete('cascade');
          $table->string('status');
          $table->timestamps();
        });

        Schema::create('pelabuhan', function(Blueprint $table) {
          $table->id();
          $table->string('kode');
          $table->string('nama');
          $table->unsignedBigInteger('id_kab')->onDelete('cascade');
          $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
          $table->unsignedBigInteger('id_prov')->onDelete('cascade');
          $table->foreign('id_prov')->references('id_prov')->on('provinsi');
          $table->string('status');
          $table->timestamps();
        });

        Schema::create('stasiun', function(Blueprint $table) {
          $table->id();
          $table->string('kode');
          $table->string('nama');
          $table->unsignedBigInteger('id_kab')->onDelete('cascade');
          $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
          $table->unsignedBigInteger('id_prov')->onDelete('cascade');
          $table->foreign('id_prov')->references('id_prov')->on('provinsi');
          $table->string('status');
          $table->timestamps();
        });

        Schema::create('terminal', function(Blueprint $table) {
          $table->id();
          $table->string('kode');
          $table->string('nama');
          $table->unsignedBigInteger('id_kab')->onDelete('cascade');
          $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
          $table->unsignedBigInteger('id_prov')->onDelete('cascade');
          $table->foreign('id_prov')->references('id_prov')->on('provinsi');
          $table->string('status');
          $table->timestamps();
        });

        Schema::create('kode_pos', function(Blueprint $table) {
          $table->id();
          $table->string('kode');
          $table->unsignedBigInteger('id_kel')->onDelete('cascade')->nullable();
          $table->foreign('id_kel')->references('id_kel')->on('kelurahan');
          $table->unsignedBigInteger('id_kec')->onDelete('cascade')->nullable();
          $table->foreign('id_kec')->references('id_kec')->on('kecamatan');
          $table->unsignedBigInteger('id_kab')->onDelete('cascade');
          $table->foreign('id_kab')->references('id_kab')->on('kabupaten');
          $table->unsignedBigInteger('id_prov')->onDelete('cascade');
          $table->foreign('id_prov')->references('id_prov')->on('provinsi');
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
        //
        Schema::dropIfExists('bandara');
        Schema::dropIfExists('pelabuhan');
        Schema::dropIfExists('stasiun');
        Schema::dropIfExists('terminal');
    }
}
