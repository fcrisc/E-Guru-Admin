<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'reference_id',
        'first_name',
        'last_name',
        'ic_number',
        'gender',
        'dob',
        'status',
        'remarks',

    ];

    public function classrooms() {

        return $this->belongsToMany(Classroom::class, 'classroom_student');
    }

    public function batch_classrooms() {

        return $this->belongsTo(BatchClassroom::class, 'batch_classroom_id');
    }


}
