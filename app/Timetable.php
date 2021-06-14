<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{

    protected $fillable = [
        'teacher_id', 'day_id', 'classroom_id', 'class_id',
        'time_start', 'time_end', 'batch_id', 'course_id',
    ];

    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->time_start)->diffInMinutes($this->time_end);
    }

    public function getTimeStartAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    // public function setTimeStartAttribute($value)
    // {
    //     $this->attributes['time_start'] = $value ? Carbon::createFromFormat(
    //         config('panel.lesson_time_format'),
    //         $value
    //     )->format('H:i:s') : null;
    // }

    public function getTimeEndAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    // public function setTimeEndAttribute($value)
    // {
    //     $this->attributes['time_end'] = $value ? Carbon::createFromFormat(
    //         config('panel.lesson_time_format'),
    //         $value
    //     )->format('H:i:s') : null;
    // }


    public static function isTimeAvailable($day_id, $classroom_id,  $time_start, $time_end, $batch_id, $timetable)
    {
        return !self::where('day_id', $day_id)
            ->when($timetable, function ($query) use ($timetable) {
                $query->where('id', '!=', $timetable->id);
            })
            ->where('classroom_id', $classroom_id)
            ->where('batch_id', $batch_id)
            ->where([
                ['time_start', '<', $time_end],
                ['time_end', '>', $time_start],
            ])
            ->count();
    }

    public function scopeCalendarByRoleOrClassId($query)
    {
        return $query->when(!request()->input('class_id'), function ($query) {
            $query->when(auth()->user()->is_teacher, function ($query) {
                $query->where('teacher_id', auth()->user()->id);
            });

        })
            ->when(request()->input('class_id'), function ($query) {
                $query->where('classroom_id', request()->input('class_id'));
            });
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function batches()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function days()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'courses_id');
    }
}
