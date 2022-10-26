<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_name',
        'assignee',
        'start_datte',
        'odometer',
        'comment',
        'status'
    ];
}
