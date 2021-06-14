<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        return view('admin.courses.index', ['courses'=> $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'course_name'  => 'required|max:255',
            'course_code'  => 'required|max:255|unique:courses',
            'description'  => 'required|max:255'
        ]);

        $courses = new Course();
        $courses->course_name = $request->get('course_name');
        $courses->course_code = $request->get('course_code');
        $courses->description = $request->get('description');
        $courses->save();

        return redirect()->route('courses.index')->with('success', 'Successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::find($id);
        return view('admin.courses.edit')->with(compact('courses'));
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
        $courses = Course::find($id);
        $request->validate([
            'course_name'  => 'required|string|max:255',
            'course_code' => 'required|string|max:255|unique:courses,course_code,'.$courses->id,
            'description'   => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $courses -> update([
            'course_name'        => $request->course_name,
            'course_code'        => $request->course_code,
            'description'        => $request->description,
            'status'             => $request->status
        ]);

        return redirect()->route('courses.index')->with('success', 'Successfully updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courses = Course::find($id);

        if($courses->timetables()->count()){
            return back()->with('abort','Cannot delete, subject currently being use');
        }

        $courses->delete();

        return redirect()->route('courses.index')->with('success', 'Successfully deleted');
    }
}
