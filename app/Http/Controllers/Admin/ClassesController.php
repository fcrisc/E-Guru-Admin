<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::orderBy('id', 'desc')->get();
        return view('admin.classes.index', ['classes'=> $classes]);
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
            'class_name'  => 'required|max:255',
            'class_code'  => 'required|max:255|unique:classes'
        ]);

        $classes = new Classes();
        $classes->class_name = $request->get('class_name');
        $classes->class_code = $request->get('class_code');
        $classes->save();

        return redirect()->route('classes.index')->with('success', 'Successfully added');
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
        $classes = Classes::find($id);
        return view('admin.classes.edit')->with(compact('classes'));
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
        $classes = Classes::find($id);
        $request->validate([
            'class_name'  => 'required|string|max:255',
            'class_code' => 'required|string|max:255|unique:classes,class_code,'.$classes->id
        ]);

        $classes -> update([
            'class_name'        => $request->class_name,
            'class_code'        => $request->class_code
        ]);

        return redirect()->route('classes.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classes = Classes::find($id);

        if($classes->timetables()->count()){

            return back()->with('abort','Cannot delete, class currently being use');
        }

        $classes->delete();

        return redirect()->route('classes.index')->with('success', 'Successfully deleted');
    }
}
