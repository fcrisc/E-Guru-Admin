<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email enter not found in our records.',
                'errors' => 'Invalid data'
            ]);
        } else if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credential.',
                'errors' => 'Invalid data'
            ]);
        } else {

        }

        return response()->json([
            'message' => 'Success',
            'user_id' => $user->id,
            'user_firstname' => $user->first_name,
            'user_lastname' => $user->last_name,
            'user_avatar' => $user->avatar,
            'user_email' => $user->email,
            'token' => $user->createToken($request->email)->plainTextToken,
        ]);
    }

    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';
        return response()->json($this->response, 200);

    }

    public function getCurrentUser()
    {
        $user = Auth::user();
        $this->response['message']='success';
        $this->response['data'] = $user ;

        return response()->json($this->response, 200);
    }

    public function student_list()
    {
        // $student = Student::find(1);
        // return new StudentResource($student);

        $students = Student::all();
        return StudentResource::collection($students);
    }
}
