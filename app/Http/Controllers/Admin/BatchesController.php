<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Batch;

class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::orderBy('id', 'asc')->get();
        return view('admin.batches.index', ['batches'=>$batches]);
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
            'batch'  => 'required|max:255|unique:batches'
        ]);

        $batches = new Batch();
        $batches->batch = $request->get('batch');
        $batches->save();

        return redirect()->route('batches.index')->with('success', 'Successfully added');
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
        $batches = Batch::find($id);
        return view('admin.batches.edit')->with(compact('batches'));
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
        $batches = Batch::find($id);
        $request->validate([
            'batch' => 'required|string|max:255|unique:batches,batch,'.$batches->id
        ]);

        $batches -> update([
            'batch'        => $request->batch
        ]);

        return redirect()->route('batches.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batches = Batch::find($id);

        if($batches->timetables()->count()){

            return back()->with('abort','Cannot delete, year currently being use');

        }

        if($batches->classrooms()->count()){

            return back()->with('abort','Cannot delete, year currently being use');
        }

        $batches->delete();

        return redirect()->route('batches.index')->with('success', 'Successfully deleted');
    }
}
