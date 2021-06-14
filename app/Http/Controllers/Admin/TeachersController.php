<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::where('id', 2)->get();

        return view('admin.teachers.index', compact('roles'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $password = $request->get('password');

        $users = new User();
        $users->first_name = $request->get('first_name');
        $users->last_name = $request->get('last_name');
        $users->email = $request->get('email');
        $users->password = Hash::make($password);

        $users->save();

        $users->roles()->attach(2);

        return redirect()->route('teachers.index')->with('success', 'Successfully registered');


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
        $users = User::find($id);
        return view('admin.teachers.edit')->with(compact('users'));
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
        $users = User::find($id);

        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$users->id
        ]);




        $users->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email

        ]);

        return redirect()->route('teachers.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);

        if($users->timetables()->count()){
            return back()->with('abort','Cannot delete, teacher currently being use');
        }

        $users->roles()->detach();

        $users->delete();

        return redirect()->route('teachers.index')->with('success', 'Successfully deleted');
    }

    public function changePasswordForm($id)
    {
        $users = User::find($id);
        return view('admin.teachers.changePasswordForm')->with(compact('users'));
    }

    public function changePassword(Request $request, $id)
    {
        $users = User::find($id);
        if (!(Hash::check($request->get('currentpassword'), $users->password))) {
            return back()->with([
                'msg_currentpassword' => 'Current password does not match'
            ]);
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){
            return back()->with([
                'msg_currentpassword' => 'New Password is the same as current password'
            ]);
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword'     => 'required|string|min:8|confirmed',
        ]);

        $users->password = bcrypt($request->get('newpassword'));
        $users->save();

        return redirect()->route('teachers.index')->with('success', 'Password successfully updated');
    }

    protected function deleteOldImage($id){

        $users = User::find($id);
        if($users->avatar) {
            Storage::delete('/public/image/'. $users->avatar);
        }

    }

}
