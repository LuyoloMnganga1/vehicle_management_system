<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'full_name',
        'trip_start_date',
        'trip_end_date',
        'start_odometer',
        'kilometers',
        'destination_start',
        'destination_end',
        'trip_datails',
        'petrol',
        'oil',
        'start_comment',
        'return_date_out',
        'return_date_in',
        'return_odometer',
        'return_kilometers',
        'return_destination_start',
        'return_destination_end',
        'return_petrol',
        'return_oil',
        'return_comment'

    ];
}
