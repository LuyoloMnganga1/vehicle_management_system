<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'maintenance_date',
        'vehicle_id',
        'service_provider',
        'odometer',
        'current_millage',
        'next_service_millage'
       
    ];
}
