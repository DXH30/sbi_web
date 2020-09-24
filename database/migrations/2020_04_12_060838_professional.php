<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Professional extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professional', function (Blueprint $table) {
			$table->id();
      $table->string('noanggota')->nullable();
			$table->string('nama');
			$table->string('email');
			$table->string('keahlian');
			$table->string('alamat');
			$table->string('rtrw');
			$table->unsignedBigInteger('id_kel')->nullable();
			$table->foreign('id_kel')->references('id_kel')->on('kelurahan')->onDelete('cascade');
			$table->unsignedBigInteger('id_kec')->nullable();
			$table->foreign('id_kec')->references('id_kec')->on('kecamatan')->onDelete('cascade');
			$table->unsignedBigInteger('id_kab');
			$table->foreign('id_kab')->references('id_kab')->on('kabupaten')->onDelete('cascade');
			$table->unsignedBigInteger('id_prov');
			$table->foreign('id_prov')->references('id_prov')->on('provinsi')->onDelete('cascade');
			$table->Integer('kode_pos');
			$table->string('npwp');
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->string('nik');
			$table->string('nama_perusahaan');
			$table->string('email_perusahaan');
			$table->string('foto');
			$table->string('foto_ktp');
			$table->UnsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedBigInteger('asos_id');
			$table->foreign('asos_id')->references('id')->on('asosiasi')->onDelete('cascade');
			$table->unsignedBigInteger('rayon_id');
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
		Schemma::dropIfExist('professional');
	}
}
