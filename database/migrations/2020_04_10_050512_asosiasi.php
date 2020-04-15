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
        Schema::create('rayon', function(Blueprint $table) {
            $table->id();
            $table->string('nama');
        });

        Schema::create('lettercode', function(Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('keterangan');
        });

        Schema::create('asosiasi', function(Blueprint $table) {
            $table->id();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asosiasi');
        Schema::dropIfExists('lettercode');
        Schema::dropIfExists('rayon');
    }
}
