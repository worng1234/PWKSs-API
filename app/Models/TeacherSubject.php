<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $fillable = [
        't_id',
        'subject_code',
        'subject_name',
        'term',
        'year',
    ];
}