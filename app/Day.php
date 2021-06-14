<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'name',
    ];

    public function timetables() {

        return $this->hasMany(Timetable::class, 'day_id', 'id');

    }
}
