<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Semester;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::orderBy('id', 'desc')->get();
        return view('admin.semesters.index', ['semesters'=> $semesters]);
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
            'semester_name'  => 'required|max:255',
            'semester_code'  => 'required|max:255|unique:semesters',
            'duration'  => 'required|max:255',
            'description'  => 'required|max:255'
        ]);

        $semesters = new Semester();
        $semesters->semester_name = $request->get('semester_name');
        $semesters->semester_code = $request->get('semester_code');
        $semesters->duration = $request->get('duration');
        $semesters->description = $request->get('description');
        $semesters->save();

        return redirect()->route('semesters.index')->with('success', 'Successfully added');
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
        $semesters = Semester::find($id);
        return view('admin.semesters.edit')->with(compact('semesters'));
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
        $semesters = Semester::find($id);
        $request->validate([
            'semester_name'  => 'required|string|max:255',
            'semester_code' => 'required|string|max:255|unique:semesters,semester_code,'.$semesters->id,
            'duration'   => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $semesters -> update([
            'semester_name'        => $request->semester_name,
            'semester_code'        => $request->semester_code,
            'duration'        => $request->duration,
            'description'             => $request->description
        ]);

        return redirect()->route('semesters.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semesters = Semester::find($id);

        $semesters->delete();

        return redirect()->route('semesters.index')->with('success', 'Successfully deleted');
    }
}
