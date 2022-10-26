<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_name',
        'assignee',
        'title',
        'description',
        'issue_image',
        'priority',
        'due_date'
    ];
}
