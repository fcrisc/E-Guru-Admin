<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('sanctum:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/student', 'API\LoginController@student_list');
    Route::post('/logout', 'API\LoginController@logout');
    Route::get('/dashboard', 'API\LoginController@getCurrentUser');
    Route::get('/classroom', 'API\AttendanceController@getClassroom');
    Route::get('/classroom/student-list/{batch_classroom_id}', 'API\AttendanceController@getStudent');
    Route::get('/timetable', 'API\AttendanceController@getTimetable');
    Route::post('/postcomplaint', 'API\ComplaintController@postComplaint');
    Route::get('/getcomplaint', 'API\ComplaintController@getComplaint');
});

Route::post('/login', 'API\LoginController@login');
