<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherConsults extends Model
{
    protected $fillable = [
        't_id',
        'class',
        'room',
        'year',
    ];
}