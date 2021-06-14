<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'classroom_name', 'classroom_code', 'classroom_description', 'classroom_status',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_classroom');
    }

    public function timetables()
    {

        return $this->hasMany(Timetable::class, 'classroom_id', 'id');

    }
}
