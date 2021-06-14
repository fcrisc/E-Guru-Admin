<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complaint;

class ComplaintController extends Controller
{
    public function postComplaint(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'complaint_type' => 'required',
            'complaint_description' => 'required',
        ]);

        $complaint = new Complaint();

        $complaint->user_id = $request->input('user_id');
        $complaint->complaint_type = $request->input('complaint_type');
        $complaint->complaint_description = $request->input('complaint_description');
        $complaint->save();
        return response()->json([
            "message" => "Success",
        ]);
    }

    public function getComplaint(Request $request)
    {
        $user = $request->user();
        $complaints = Complaint::with('user')
        ->where('user_id', $user->id)
        ->get();

        return $complaints->toJson();
    }
}
