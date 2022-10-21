<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_passwords extends Model
{
    use HasFactory;
    protected $table = "user_passwords";
    protected  $fillable = [
        'user_id',
        'old_password',
    ];
}
