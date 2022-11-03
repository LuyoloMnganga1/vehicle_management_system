<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_name',
        'start_datte',
        'odometer',
        'partial_fuel',
        'price',
        'vendor',
        'invoice_no',
        'invoice_upload'
    ];
}
