<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahanAlamatDiKolomKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('kendaraan', function(Blueprint $table) {
          $table->unsignedBigInteger('id_bandara')->nullable();
          $table->foreign('id_bandara')->references('id')->on('bandara')->onDelete('cascade');
          $table->unsignedBigInteger('id_pelabuhan')->nullable();
          $table->foreign('id_pelabuhan')->references('id')->on('pelabuhan')->onDelete('cascade');
          $table->unsignedBigInteger('id_stasiun')->nullable();
          $table->foreign('id_stasiun')->references('id')->on('stasiun')->onDelete('cascade');
          $table->unsignedBigInteger('id_terminal')->nullable();
          $table->foreign('id_terminal')->references('id')->on('terminal')->onDelete('cascade');
          $table->unsignedBigInteger('id_kode_pos')->nullable();
          $table->foreign('id_kode_pos')->references('id')->on('kode_pos')->onDelete('cascade');
        });
        
        Schema::table('ketersediaan_kendaraan', function(Blueprint $table) {
          $table->unsignedBigInteger('id_bandara')->nullable();
          $table->foreign('id_bandara')->references('id')->on('bandara')->onDelete('cascade');
          $table->unsignedBigInteger('id_pelabuhan')->nullable();
          $table->foreign('id_pelabuhan')->references('id')->on('pelabuhan')->onDelete('cascade');
          $table->unsignedBigInteger('id_stasiun')->nullable();
          $table->foreign('id_stasiun')->references('id')->on('stasiun')->onDelete('cascade');
          $table->unsignedBigInteger('id_terminal')->nullable();
          $table->foreign('id_terminal')->references('id')->on('terminal')->onDelete('cascade');
          $table->unsignedBigInteger('id_kode_pos')->nullable();
          $table->foreign('id_kode_pos')->references('id')->on('kode_pos')->onDelete('cascade');
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
    }
}
