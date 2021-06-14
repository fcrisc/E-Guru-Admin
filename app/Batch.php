<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'batch',
    ];

    public function students()
    {
        return $this->hasMany(ClassroomStudent::class, 'classroom_student')->withTimestamps();
    }

    public function classrooms(){

        return $this->belongsToMany(Classroom::class, 'batch_classroom');
    }

    public function timetables() {

        return $this->hasMany(Timetable::class, 'batch_id', 'id');

    }


}
