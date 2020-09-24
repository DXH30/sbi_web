<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Revisi28Juli2020 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('consul_barang', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('asal_kota_id');
            $table->foreign('asal_kota_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('tujuan_kota_id');
            $table->foreign('tujuan_kota_id')->references('id_kab')->on('kabupaten');
            $table->string('type_truck_id');
            $table->string('sisa_load');
            $table->date('tanggal');
            $table->string('jenis_barang');
            $table->timestamps();
        });

        Schema::create('port_handling', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('kel_id');
            $table->foreign('kel_id')->references('id_kel')->on('kelurahan');
            $table->unsignedBigInteger('kec_id');
            $table->foreign('kec_id')->references('id_kec')->on('kecamatan');
            $table->string('kode_pos');
            $table->string('bandara');
            $table->string('minimal_kg');
            $table->string('estimasi_hari');
            $table->string('harga_kg');
            $table->timestamps();
        });

        Schema::create('konsolidator', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('bandara');
            $table->unsignedBigInteger('harga_kg');
            $table->string('alamat');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('kel_id');
            $table->foreign('kel_id')->references('id_kel')->on('kelurahan');
            $table->unsignedBigInteger('kec_id');
            $table->foreign('kec_id')->references('id_kec')->on('kecamatan');
            $table->string('kode_pos');
            $table->string('contact_person');
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('regulated_agent', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('bandara');
            $table->string('alamat');
            $table->string('harga_kg');
            $table->string('administrasi');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('kec_id');
            $table->foreign('kec_id')->references('id_kec')->on('kecamatan');
            $table->unsignedBigInteger('kel_id');
            $table->foreign('kel_id')->references('id_kel')->on('kelurahan');
            $table->string('kode_pos');
            $table->string('contact_person');
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('airport_warehouse', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('bandara');
            $table->string('alamat');
            $table->string('harga_kg');
            $table->string('administrasi');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('kec_id');
            $table->foreign('kec_id')->references('id_kec')->on('kecamatan');
            $table->unsignedBigInteger('kel_id');
            $table->foreign('kel_id')->references('id_kel')->on('kelurahan');
            $table->string('kode_pos');
            $table->string('contact_person');
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('packing', function(Blueprint $table) {
            $table->id();
            $table->string('bandara');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('airwaybill');
            $table->unsignedBigInteger('administrasi');
            $table->unsignedBigInteger('dus_rapping');
            $table->unsignedBigInteger('kayu_dus_rapping');
            $table->string('alamat');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->string('contact_person');
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('agent_cargo', function(Blueprint $table) {
            $table->id();
            $table->string('bandara');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('asal_kota_id');
            $table->foreign('asal_kota_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('tujuan_kota_id');
            $table->foreign('tujuan_kota_id')->references('id_kab')->on('kabupaten');
            $table->string('rate_scheme');
            $table->string('commodity');
            $table->string('commodity_code');
            $table->string('charge_kg');
            $table->string('other_charge');
            $table->timestamps();
        });

        Schema::create('port_to_port', function(Blueprint $table) {
            $table->id();
            $table->string('bandara');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('asal_kota_id');
            $table->foreign('asal_kota_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('tujuan_kota_id');
            $table->foreign('tujuan_kota_id')->references('id_kab')->on('kabupaten');
            $table->string('rate_scheme');
            $table->string('commodity');
            $table->string('commodity_code');
            $table->string('charge_kg');
            $table->string('other_charge');
            $table->string('admin_charge');
            $table->string('handle_charge');
            $table->timestamps();
        });

        Schema::create('door_to_door', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('asal_kota_id');
            $table->foreign('asal_kota_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('tujuan_kota_id');
            $table->foreign('tujuan_kota_id')->references('id_kab')->on('kabupaten');
            $table->string('harga');
            $table->string('administrasi');
            $table->string('minimal');
            $table->string('jenis_barang');
            $table->timestamps();
        });

        Schema::create('order_truck_services', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('pickup_location');
            $table->string('destination');
            $table->string('type_truck_id');
            $table->date('load_date');
            $table->date('unloading_date');
            $table->unsignedBigInteger('total_units');
            $table->unsignedBigInteger('estimated_total_weight');
            $table->string('type_of_goods');
            $table->timestamps();
        });

        Schema::create('gudang', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('alamat');
            $table->unsignedBigInteger('kab_id');
            $table->foreign('kab_id')->references('id_kab')->on('kabupaten');
            $table->unsignedBigInteger('kec_id');
            $table->foreign('kec_id')->references('id_kec')->on('kecamatan');
            $table->unsignedBigInteger('kel_id');
            $table->foreign('kel_id')->references('id_kel')->on('kelurahan');
            $table->string('kode_pos');
            $table->string('jenis');
            $table->string('deskripsi');
            $table->text('kapasitas');
            $table->text('fasilitas');
            $table->text('sewa');
            $table->string('foto_gudang');
            $table->unsignedBigInteger('size_pallet');
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
        Schema::dropIfExists('consul_barang');
        Schema::dropIfExists('konsolidator');
        Schema::dropIfExists('regulated_agent');
        Schema::dropIfExists('airport_warehouse');
        Schema::dropIfExists('packing');
        Schema::dropIfExists('agent_cargo');
        Schema::dropIfExists('port_to_port');
        Schema::dropIfExists('door_to_door');
        Schema::dropIfExists('order_truck_services');
        Schema::dropIfExists('gudang');
    }
}
