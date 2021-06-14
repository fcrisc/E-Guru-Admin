<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Batch;
use App\User;
use App\Day;
use App\Classroom;
use App\Classes;
use App\Timetable;
use App\Course;
use App\Role;
use Illuminate\Http\Request;

class TimetablesController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function($role){
            $role->where('id', 2);
         })->get();

        $timetables = Timetable::orderBy('id', 'desc')->get();
        $batches = Batch::orderBy('id', 'desc')->get();
        $days = Day::orderBy('id', 'asc')->get();
        // $classrooms = Classroom::orderBy('id', 'desc')->get();
        $classrooms = Classroom::whereHas('batches', function($batch){
            $batch->where('batch', now()->year);
         })->get();
        $classes = Classes::orderBy('id', 'desc')->get();
        $courses = Course::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();

        return view('admin.timetable.index', compact(
            'roles',
            'timetables',
            'users',
            'batches',
            'days',
            'roles',
            'courses',
            'classes',
            'classrooms'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher'  => 'required',
            'day'  => 'required',
            'classroom' => 'required',
            'location' =>  'required',
            'start_time' =>  'required',
            'end_time' => 'required',
            'year' => 'required',
            'subject' => 'required',
        ]);

        $isTimeAvailable = Timetable::isTimeAvailable(
            $request['day'],
            $request['classroom'],
            $request['start_time'],
            $request['end_time'],
            $request['year'],
            null
        );

        // throw new \Exception('');

        if ($isTimeAvailable) {
            $timetable = new Timetable();
            $timetable->teacher_id = $request->get('teacher');
            $timetable->day_id = $request->get('day');
            $timetable->classroom_id = $request->get('classroom');
            $timetable->class_id = $request->get('location');
            $timetable->courses_id = $request->get('subject');
            $timetable->time_start = $request->get('start_time');
            $timetable->time_end = $request->get('end_time');
            $timetable->batch_id = $request->get('year');

            $timetable->save();

            return redirect()->route('timetables.index')->with('success', 'Successfully added');
        } else {

            return redirect()->back()->with('abort', 'The time selected is not available');
        }
    }

    public function edit($id)
    {
        $timetables = Timetable::find($id);

        $batches = Batch::orderBy('id', 'desc')->get();
        $days = Day::orderBy('id', 'asc')->get();
        $users = User::orderBy('id', 'desc')->get();
        $classrooms = Classroom::orderBy('id', 'desc')->get();
        $classes = Classes::orderBy('id', 'desc')->get();
        $courses = Course::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();

        return view('admin.timetable.edit', compact(
            'timetables',
            'roles',
            'users',
            'batches',
            'days',
            'courses',
            'classes',
            'classrooms'
        ));
    }

    public function update(Request $request, $id)
    {
        $timetable = Timetable::find($id);

        $request->validate([
            'teacher'  => 'required',
            'day'  => 'required',
            'classroom' => 'required',
            'location' =>  'required',
            'start_time' =>  'required',
            'end_time' => 'required',
            'year' => 'required',
            'subject' => 'required',
        ]);

        $isTimeAvailable = Timetable::isTimeAvailable(
            $request['day'],
            $request['classroom'],
            $request['start_time'],
            $request['end_time'],
            $request['year'],
            $timetable
        );

        if ($isTimeAvailable) {
            $timetable->teacher_id = $request->get('teacher');
            $timetable->day_id = $request->get('day');
            $timetable->classroom_id = $request->get('classroom');
            $timetable->class_id = $request->get('location');
            $timetable->courses_id = $request->get('subject');
            $timetable->time_start = $request->get('start_time');
            $timetable->time_end = $request->get('end_time');
            $timetable->batch_id = $request->get('year');
            $timetable->save();
            return redirect()->route('timetables.index')->with('success', 'Successfully updated');
        } else {
            return redirect()->back()->with('abort', 'The time selected is not available');
        }
    }

    public function destroy($id)
    {
        $timetables = Timetable::find($id);

        $timetables->delete();

        return redirect()->route('timetables.index')->with('success', 'Successfully deleted');
    }
}
