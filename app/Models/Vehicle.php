<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_type',
        'vehicle_name',
        'vehicle_model',
        'year',
        'vehicle_image',
        'vehicle_status',
        'Registration_no',
        'engine_no',
        'chassis_no',
        'fuel_type',
        'fuel_measurement',
        'vehicle_usage',
        'aux_meter'
    ];
}
