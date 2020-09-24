<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahTabelIuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iuran', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asos_id')->nullable();
            $table->foreign('asos_id')->references('id')->on('asosiasi');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->unsignedBigInteger('harga_per_bulan')->nullable();
            $table->unsignedBigInteger('harga_per_tahun')->nullable();
            $table->timestamps();
        });

        Schema::create('data_iuran', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iuran_id');
            $table->foreign('iuran_id')->references('id')->on('iuran');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('terkonfirmasi')->default(false);
            $table->string('bukti_pembayaran');
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
        Schema::dropIfExists('data_iuran');
        Schema::dropIfExists('iuran');
    }
}
