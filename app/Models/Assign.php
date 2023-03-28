<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;
    protected $fillable = [
        'assignee',
        'email',
        'licence_no',
        'department',
        'Registration_no',
        'odometer',
        'assigned_status',
        'comment',
        
    ];
}
