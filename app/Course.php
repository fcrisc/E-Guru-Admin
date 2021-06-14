<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name', 'course_code', 'description', 'status',
    ];

    public function timetables() {

        return $this->hasMany(Timetable::class, 'courses_id', 'id');

    }
}
