<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Time
{
    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeRange = [];

        do
        {
            $start = $time->format("H:i");
            if ($time->format("H:i") == '10:10') {
                $end = $time->addMinutes(20)->format("H:i");
            } else {
                $end = $time->addMinutes(30)->format("H:i");
            }
            array_push($timeRange, [
                'start' => $start,
                'end' => $end
            ]);
        } while ($time->format("H:i") !== $to);

        return $timeRange;
    }
}
