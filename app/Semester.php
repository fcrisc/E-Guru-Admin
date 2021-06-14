<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'semester_name', 'semester_code', 'duration', 'description',
    ];
}
