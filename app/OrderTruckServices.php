<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTruckServices extends Model
{
    //
    protected $table = 'order_truck_services';
    protected $fillable = ['user_id', 'pickup_location', 'destination', 'type_truck_id', 'load_date', 'unloading_date', 'total_units', 'estimated_total_weight', 'type_of_goods', 'created_at', 'updated_at'];
}
