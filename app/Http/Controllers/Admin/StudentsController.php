<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Student;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->get();
        return view('admin.students.index', compact('students'));
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
            'first_name'  => 'required|max:255|string',
            'last_name'  => 'required|max:255|string',
            'ic_number'  => 'required|regex:/^\d{6}-\d{2}-\d{4}$/|unique:students',
            'gender'  => 'required|string',
            'dob'  => 'required|date'
        ]);

        $students = new Student();
        $students->reference_id = 0;
        $students->first_name = $request->get('first_name');
        $students->last_name = $request->get('last_name');
        $students->ic_number = $request->get('ic_number');
        $students->gender = $request->get('gender');
        $students->dob = $request->get('dob');
        $students->remarks = $request->get('remarks');
        $students->save();

        $students -> reference_id = IdGenerator::generate(['table' => 'students', 'length' => 8, 'prefix' =>date('ymhs')]).$students->id;
        $students ->save();

        return redirect()->route('students.index')->with('success', 'Successfully added');
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
        $students = Student::find($id);
        return view('admin.students.edit')->with(compact('students'));
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
        $students = Student::find($id);
        $request->validate([
            'first_name'  => 'required|max:255|string',
            'last_name'  => 'required|max:255|string',
            'ic_number'  => 'required|regex:/^\d{6}-\d{2}-\d{4}$/|unique:students,ic_number,'.$students->id,
            'gender'  => 'required|string',
            'dob'  => 'required|date'
        ]);

        $students -> update([
            'first_name'        => $request->first_name,
            'last_name'        => $request->last_name,
            'ic_number'        => $request->ic_number,
            'gender'             => $request->gender,
            'dob'             => $request->dob,
            'status'             => $request->status,
            'remarks'             => $request->remarks
        ]);

        return redirect()->route('students.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = Student::find($id);

        if($students->classrooms()->count()){

            return back()->with('abort','Cannot delete, student currently being use');
        }

        if($students->batch_classrooms()->count()){

            return back()->with('abort','Cannot delete, student currently being use');
        }

        $students->delete();

        return redirect()->route('students.index')->with('success', 'Successfully deleted');
    }

    public function generateQrcode($id)
    {
        $students = Student::find($id);

        return view('admin.students.qrcode')->with(compact('students'));
    }

    public function printQrcode($id)
    {
        $students = Student::find($id);

        return view('admin.students.qrcode-print')->with(compact('students'));
    }

}
