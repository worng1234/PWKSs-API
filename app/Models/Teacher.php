<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'roll',
    ];
}