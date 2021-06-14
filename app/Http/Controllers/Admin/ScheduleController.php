<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Timetable;
use App\Schedule;
use App\Day;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Schedule $schedule)
    {
        $days = Day::orderBy('id')->get();

        $weekDays     = Timetable::WEEK_DAYS;
        $calendarData = $schedule->generateCalendarData($weekDays);

        return view('admin.schedule', compact('weekDays', 'calendarData'));
    }
}
