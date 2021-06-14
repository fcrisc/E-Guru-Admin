<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'class_name', 'class_code',
    ];

    public function timetables() {

        return $this->hasMany(Timetable::class, 'class_id', 'id');

    }
}
