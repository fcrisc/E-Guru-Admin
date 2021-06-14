<?php

use App\Http\Controllers\Admin\ClassRoomsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changePassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changePassword', 'HomeController@changePassword')->name('profile.changepassword');

});

//Admin route

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {

Route::resource('users', 'UsersController');
Route::resource('teachers', 'TeachersController');
Route::delete('teachers/{id}/destroy', 'TeachersController@destroy')->name('teachers.destroy');
Route::get('teachers/{id}/changePasswordForm', 'TeachersController@changePasswordForm')->name('teachers.changePasswordForm');
Route::post('teachers/{id}/changePassword', 'TeachersController@changePassword')->name('teachers.changepassword');
Route::resource('roles', 'RolesController');
Route::resource('courses', 'CoursesController');
Route::delete('courses/{id}/destroy', 'CoursesController@destroy')->name('courses.destroy');
Route::resource('batches', 'BatchesController');
Route::delete('batches/{id}/destroy', 'BatchesController@destroy')->name('batches.destroy');
Route::resource('days', 'DaysController');
Route::delete('days/{id}/destroy', 'DaysController@destroy')->name('days.destroy');
Route::resource('class_rooms', 'ClassRoomsController');
Route::get('class_rooms/{id}', 'ClassRoomsController@show');
Route::get('class_details', 'ClassRoomsController@detail')->name('class_rooms.detail');
Route::delete('class_rooms/{id}/destroy', 'ClassRoomsController@destroy')->name('classroom.destroy');
Route::post('class_rooms/attachStudent/{id}', 'ClassRoomsController@studentAttach')->name('class_rooms.attachStudent');
Route::delete('class_rooms/attachStudent/{batch_classroom_id}/{student_id}', 'ClassRoomsController@studentDetach')->name('class_rooms.destroy');
Route::resource('semesters', 'SemestersController');
Route::delete('semesters/{id}/destroy', 'SemestersController@destroy')->name('semesters.destroy');
Route::resource('classes', 'ClassesController');
Route::delete('classes/{id}/destroy', 'ClassesController@destroy')->name('classes.destroy');
Route::resource('students', 'StudentsController');
Route::delete('students/{id}/destroy', 'StudentsController@destroy')->name('students.destroy');
Route::get('students/qrcode-print/{id}', 'StudentsController@printQrcode')->name('students.qrcode.print');
Route::get('all-notifications', 'PushNotificationController@index')->name('push_notifications.index');
Route::post('all-notifications', 'PushNotificationController@store')->name('push_notifications.store');
Route::get('all-notifications/create', 'PushNotificationController@create')->name('push_notifications.create');
Route::get('students/qrcode/{id}', 'StudentsController@generateQrcode')->name('students.qrcode');
Route::get('attendances/{id}/index', 'ClassRoomsController@attendance')->name('attendances.index');
Route::post('attendances/{id}/dateFilter', 'ClassRoomsController@dateFilter')->name('attendances.dateFilter');
Route::post('attendances/{id}/generate', 'ClassRoomsController@generateAttendance')->name('attendances.generateAttendance');
Route::get('attendances/changeStatus/{id}', 'ClassRoomsController@changeStatus');
Route::get('timetables', 'TimetablesController@index')->name('timetables.index');
Route::post('timetables', 'TimetablesController@store')->name('timetables.store');
Route::get('timetables/{id}/edit', 'TimetablesController@edit')->name('timetables.edit');
Route::post('timetables/{id}/update', 'TimetablesController@update')->name('timetables.update');
Route::delete('timetables/{id}/destroy', 'TimetablesController@destroy')->name('timetable.destroy');
Route::resource('complaints', 'ComplaintsController');
Route::resource('acknowledgements', 'AcknowledgementController');

Route::get('schedule', 'ScheduleController@index')->name('schedule.index');
});

