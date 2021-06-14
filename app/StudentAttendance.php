<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendance';

    public function classroom_student()
    {
        return $this->belongsTo(ClassroomStudent::class);
    }
}
