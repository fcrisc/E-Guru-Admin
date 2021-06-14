<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule
{

    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new Time)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons   = Timetable::with('classrooms', 'teacher','classes','courses')
            ->calendarByRoleOrClassId()
            ->get();

        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $lesson = $lessons->where('day_id', $index)->where('time_start', $time['start'])->first();

                if ($lesson)
                {
                    array_push($calendarData[$timeText], [
                        'classroom_name'   => $lesson->classrooms ? $lesson->classrooms->classroom_name : '',
                        'teacher_name' => $lesson->teacher ? $lesson->teacher->first_name . '  ' . $lesson->teacher->last_name : '',
                        'course' => $lesson->courses ? $lesson->courses->course_name : '',
                        'venue' => $lesson->classes ? $lesson->classes->class_name : '',
                        'rowspan'      => $lesson->difference/30 ?? ''
                    ]);
                }
                // else if ($time['start'] == '10:10')
                // {
                //     array_push($calendarData[$timeText], 'break time');
                // }
                else if (!$lessons->where('day_id', $index)->where('time_start', '<', $time['start'])->where('time_end', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        // dd($calendarData);

        return $calendarData;
    }
}


