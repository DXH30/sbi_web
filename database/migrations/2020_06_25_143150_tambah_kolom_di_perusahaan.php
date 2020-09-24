<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomDiPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('perusahaan', function(Blueprint $table) {
          $table->string('nib')->nullable();
          $table->string('kode_kbli')->nullable();
          $table->string('nama_kbli')->nullable();
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
        Schema::table('perusahaan', function(Blueprint $table) {
          $table->dropColumn([
            'nib',
            'kode_kbli',
            'nama_kbli'
          ]);
        });
    }
}
