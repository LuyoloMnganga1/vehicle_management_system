<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'surname',
        'department',
        'email',
        'phone',
        'user_type',
        'licence_no',
        'licence_class',
        'license_state',
        'license_image'
    ];
}
