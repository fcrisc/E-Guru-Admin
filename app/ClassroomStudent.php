<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    protected $table = 'classroom_student';

    protected $fillable = [
        'classroom_id', 'student_id', 'batch_classroom_id',
    ];

    public function batch_classroom()
    {
        return $this->belongsTo('App\BatchClassroom', 'batch_classroom_id');
    }

    public function student_attendances()
    {
        return $this->hasMany(StudentAttendance::class, 'classroom_student_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
