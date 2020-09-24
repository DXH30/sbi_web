<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortToPort extends Model
{
    //
    protected $table = 'port_to_port';
    protected $fillable = ['user_id', 'bandara', 'asal_kota_id', 'tujuan_kota_id', 'rate_scheme', 'commodity', 'commodity_code', 'charge_kg', 'handling_charge', 'other_charge', 'admin_charge'];
}
