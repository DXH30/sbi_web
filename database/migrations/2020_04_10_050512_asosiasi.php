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
		Schema::create('kategori', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
		});

		Schema::create('rayon', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
		});

		Schema::create('lokasi', function (Blueprint $table) {
			$table->id();
			$table->string('lettercode');
			$table->string('lokasi');
			$table->float('gps_lat')->nullable();
			$table->float('gps_long')->nullable();
		});

		Schema::create('jenis', function (Blueprint $table) {
			$table->id('id_jenis');
			$table->string('nama');
		});

		Schema::create('provinsi', function (Blueprint $table) {
			$table->id('id_prov');
			$table->string('nama');
		});

		Schema::create('kabupaten', function (Blueprint $table) {
			$table->id('id_kab');
			$table->unsignedBigInteger('id_prov');
			$table->foreign('id_prov')->references('id_prov')->on('provinsi')->onDelete('cascade');
			$table->string('nama');
			$table->unsignedBigInteger('id_jenis');
			$table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade');
		});

		Schema::create('kecamatan', function (Blueprint $table) {
			$table->id('id_kec');
			$table->unsignedBigInteger('id_kab');
			$table->foreign('id_kab')->references('id_kab')->on('kabupaten')->onDelete('cascade');
			$table->string('nama');
		});

		Schema::create('kelurahan', function (Blueprint $table) {
			$table->id('id_kel');
			$table->unsignedBigInteger('id_kec');
			$table->foreign('id_kec')->references('id_kec')->on('kecamatan')->onDelete('cascade');
			$table->string('nama');
			$table->unsignedBigInteger('id_jenis');
			$table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade');
		});

		Schema::create('nomor_anggota', function (Blueprint $table) {
			$table->id();
			$table->string('nomor');
			$table->timestamps();
		});

		Schema::create('asosiasi', function (Blueprint $table) {
			$table->id();
      $table->string('noanggota')->nullable();
			$table->unsignedBigInteger('kat_id');
			$table->foreign('kat_id')->references('id')->on('kategori')->onDelete('cascade');
			$table->string('nama');
			$table->string('telp_kantor');
			$table->string('alamat_kantor');
			$table->unsignedBigInteger('kab_id');
			$table->foreign('kab_id')->references('id_kab')->on('kabupaten')->onDelete('cascade');
			$table->unsignedBigInteger('prov_id');
			$table->foreign('prov_id')->references('id_prov')->on('provinsi')->onDelete('cascade');
			$table->string('kode_pos');
			$table->string('website');
			$table->string('no_akta_notaris');
			$table->string('no_kemenkumham');
			$table->string('nama_wakil');
			$table->string('jabatan');
			$table->string('npwp');
			$table->string('ketua_umum');
			$table->string('nik_ketum');
			$table->string('no_hp');
			$table->string('logo_asosiasi');
			$table->unsignedBigInteger('user_id')->unique();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('nomor_anggota_asosiasi', function (Blueprint $table) {
			$table->id();
			$table->string('nomor_anggota');
			$table->timestamps();
		});

		Schema::create('data_rayon', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_rayon');
			$table->foreign('id_rayon')->references('id')->on('rayon')->onDelee('cascade');
			$table->unsignedBigInteger('id_asos');
			$table->foreign('id_asos')->references('id')->on('asosiasi')->onDelete('cascade');
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
