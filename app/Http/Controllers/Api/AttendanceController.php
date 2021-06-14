<?php

namespace App\Http\Controllers\api;

use App\Batch;
use App\BatchClassroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\ClassroomStudent;
use App\Http\Resources\BatchClassroomResource;
use App\Http\Resources\ClassroomResource;
use App\Timetable;
use App\User;

class AttendanceController extends Controller
{
    public function getClassroom(Request $request )
    {
        $classrooms = BatchClassroom::with([
            'classroom',
            'batch',
        ])
        ->whereHas(
            'batch',
            function ($query) {
                $query->where('batch', now()->year);
            }
        )->orderBy('classroom_id')
            ->get();
        return $classrooms->toJson();

    }

    public function getTimetable(Request $request)
    {
        $user = $request->user();
        $timetables = Timetable::with([
            'days',
            'classrooms',
            'batches',
            'classes',
            'courses',
        ])
        ->whereHas(
            'batches',
            function ($query) {
                $query->where('batches.batch', now()->year);
            }
        )->where('teacher_id', $user->id)
        ->orderBy('day_id')
        ->orderBy('time_start')
            ->get();
        return $timetables->toJson();
    }

    public function getStudent(Request $request, $batch_classroom_id)
    {
        $classroom_students = ClassroomStudent::with('student')->where('batch_classroom_id', $batch_classroom_id)->get();
        return $classroom_students->toJson();

    }
}
