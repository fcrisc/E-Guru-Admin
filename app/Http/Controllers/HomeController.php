<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Student;
use App\Classroom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        $users = User::all();
        $students = Student::all();
        $teachers = User::whereHas('roles', function ($query) {
            return $query->where('role_id', '=', 2);
        })->get();
        $classrooms = Classroom::all();

        return view('home', compact('teachers', 'students', 'users', 'classrooms'));

    }




    public function profile()
    {
        return view('profile.index');
    }

    public function profileEdit()
    {
        return view('profile.edit');
    }

    public function profileUpdate(Request $request)
    {

        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'image' => 'image|max:1999',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id()
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->getClientOriginalName();
            $this->deleteOldImage();
            $request->image->storeAs('image', $filename, 'public');
            DB::table('users')->update(['avatar' => $filename]);
        }



        DB::table('users')

            ->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email

        ]);

        return redirect()->route('profile');
    }

    protected function deleteOldImage(){

        if(auth()->user()->avatar) {
            Storage::delete('/public/image/'. auth()->user()->avatar);
        }

    }

    public function changePasswordForm()
    {
        return view('profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
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

        $user = Auth::user();

        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Auth::logout();
        return redirect()->route('login');
    }
}
