<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCargo extends Model
{
    //
    protected $table = 'agent_cargo';
    protected $fillable = ['user_id', 'bandara', 'asal_kota_id', 'tujuan_kota_id', 'rate_scheme', 'commodity', 'commodity_code', 'charge_kg', 'other_charge'];
}
