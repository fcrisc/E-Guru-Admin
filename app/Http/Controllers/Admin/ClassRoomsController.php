<?php

namespace App\Http\Controllers\Admin;

use App\Batch;
use App\BatchClassroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classroom;
use App\ClassroomStudent;
use App\Student;
use App\StudentAttendance;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $class_room = Classroom::whereHas('batches', function($batch){
        //     $batch->where('batch', now()->year);
        //  })->get();

        $batches = Batch::orderBy('id', 'desc')->get();
        // $classrooms = Classroom::orderBy('id', 'desc')->get();

        $classrooms = BatchClassroom::whereHas('batch', function($batch){
            $batch->where('batch', now()->year);
         })->get();

        return view('admin.class_rooms.index', compact('classrooms', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail()
    {
        $classrooms = BatchClassroom::orderBy('id', 'asc')->get();
        $batches = Batch::orderBy('id', 'desc')->get();

        return view('admin.class_rooms.detail', compact('classrooms', 'batches'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom_name'  => 'required|max:255',
            'classroom_code'  => 'required|max:255|unique:classrooms',
            'classroom_description'  => 'required|max:255',
            'year'  => 'required'
        ]);



        if(BatchClassroom::whereHas('batch', function($batch) use($request){
            $batch->where('id', $request->get('year'));
         })->whereHas('classroom', function($classroom) use($request){
             $classroom->where('classroom_name', $request->get('classroom_name'));
         })->count()>0){

            return redirect()->back()->with('abort', 'Classroom in this year already exist');

        }

        $classrooms = new Classroom();
        $classrooms->classroom_name = $request->get('classroom_name');
        $classrooms->classroom_code = $request->get('classroom_code');
        $classrooms->classroom_description = $request->get('classroom_description');
        $classrooms->save();

        $classrooms->batches()->attach($request->get('year'));

        return redirect()->route('class_rooms.index')->with('success', 'Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($batch_classroom_id)
    {
        // $validate = Classroom::whereHas('batches', function ($query) use($id) {
        //     return $query->where('batch_id', '!=', $id);
        // })->get();

        $batch_classroom = BatchClassroom::find($batch_classroom_id);

        $class_student = [];
        $year = [];
        $student_all = Student::all();
        $classroom_students = ClassroomStudent::all();
        foreach ($classroom_students as $classroom_student) {
            $bc_id = $classroom_student->batch_classroom->id;
            $student_id = $classroom_student->student_id;
            $batch_year = $classroom_student->batch_classroom->batch->batch;
            $class_student[$bc_id][$student_id] = '';
            $year[$batch_year][$student_id] = '';
        }
        $students = $student_all->reject(function ($student) use ($class_student, $batch_classroom, $year) {
            if (isset($class_student[$batch_classroom->id])) {
                foreach ($class_student[$batch_classroom->id] as $key => $val) {
                    if ($key == $student->id) {
                        return true;
                    }
                }
            }
            if (isset($year[$batch_classroom->batch->batch])) {
                foreach ($year[$batch_classroom->batch->batch] as $key2 => $val2) {
                    if ($key2 == $student->id) {
                        return true;
                    }
                }
            }
            return false;
        });

        return view('admin.class_rooms.show')->with(compact('batch_classroom', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classrooms = Classroom::find($id);
        return view('admin.class_rooms.edit')->with(compact('classrooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $classrooms = Classroom::find($id);
        $request->validate([
            'classroom_name'  => 'required|string|max:255',
            'classroom_code' => 'required|string|max:255|unique:classrooms,classroom_code,' . $classrooms->id,
            'classroom_description'   => 'required|string|max:255',
            'classroom_status' => 'required'
        ]);

        $classrooms->update([
            'classroom_name'        => $request->classroom_name,
            'classroom_code'        => $request->classroom_code,
            'classroom_description'        => $request->classroom_description,
            'classroom_status'             => $request->classroom_status
        ]);

        return redirect()->route('class_rooms.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classrooms = Classroom::find($id);

        if($classrooms->students()->count()){

            return back()->with('abort','Cannot delete, classroom currently being use');
        }

        if($classrooms->timetables()->count()){

            return back()->with('abort','Cannot delete, classroom currently being use');
        }

        $classrooms->batches()->detach();
        $classrooms->delete();

        return redirect()->route('class_rooms.index')->with('success', 'Successfully deleted');
    }

    public function studentAttach(Request $request, $batch_classroom_id)
    {
        $request->validate([
            'student'  => 'required'
        ]);

        $classrooms = BatchClassroom::find($batch_classroom_id);
        //$classrooms->classroom_name = $request->get('classroom_name');
        //$classrooms->classroom_code = $request->get('classroom_code');
        //$classrooms->classroom_description = $request->get('classroom_description');
        $new = new ClassroomStudent();
        $new->classroom_id = $classrooms->classroom_id;
        $new->student_id = $request->get('student');
        $new->batch_classroom_id = $batch_classroom_id;
        $new->save();

        // $classrooms->batches()->attach($request->get('year'));

        return redirect('class_rooms/' . $batch_classroom_id)->with('success', 'Student added');
    }

    public function studentDetach(Request $request, $batch_classroom_id, $student_id)
    {
        ClassroomStudent::where('student_id', '=', $student_id)
            ->where('batch_classroom_id', '=', $batch_classroom_id)
            ->delete();

        return redirect('class_rooms/' . $batch_classroom_id)->with('abort', 'Student removed');
    }

    public function attendance(Request $request, $batch_classroom_id)
    {
        $batch_classroom = BatchClassroom::find($batch_classroom_id);
        $student_attendances = [];
        $date = '';

        return view('admin.attendances.index')->with(compact('batch_classroom', 'date', 'student_attendances'));
    }

    public function dateFilter(Request $request, $batch_classroom_id)
    {
        $date = $request->get('date');
        $dateforfilter = new DateTime($date);
        // dd($date->format('Y-m-d'));
        $batch_classroom = BatchClassroom::find($batch_classroom_id);
        $classroom_students = ClassroomStudent::where('batch_classroom_id', $batch_classroom_id)->get();
        $student_attendances = StudentAttendance::where('date', $dateforfilter->format('Y-m-d'))
                                ->whereIn('classroom_student_id', $classroom_students->modelKeys())
                                ->get();

        return view('admin.attendances.index')->with(compact('batch_classroom', 'date', 'student_attendances'));

        // return redirect('attendances/' . $batch_classroom_id . '/index')->withInput();
    }

    public function generateAttendance(Request $request, $batch_classroom_id)
    {
        $date = $request->date;
        $date = new DateTime($date);
        if (empty($date)){ return redirect()->route('attendances.index', $batch_classroom_id)->with('error', 'No date selected.'); }
        $classroom_students = ClassroomStudent::where('batch_classroom_id', $batch_classroom_id)->get();
        foreach ($classroom_students as $classroom_student) {
            $student_attendance = new StudentAttendance();
            $student_attendance->classroom_student_id = $classroom_student->id;
            $student_attendance->date = $date;
            $student_attendance->status = 0;
            $student_attendance->save();
        }
        // return back()->withInput();
        return redirect()->route('attendances.index', $batch_classroom_id);
    }

    public function changeStatus($studentAttendanceId)
    {
        $student = StudentAttendance::find($studentAttendanceId);

        if( $student->status == 0){

            $student->status = 1;
            $student->save();
            return 'Present';

        } else if( $student->status == 1) {

            $student->status = 0;
            $student->save();
            return 'Absent';

        }


    }


}
