<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'full_name',
        'email',
        'trip_start_date',
        'return_date',
        'destination',
        'vehicle_id',
        'trip_datails',
        'status',
        'comment'
    ];
}
