<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchClassroom extends Model
{

    protected $table = 'batch_classroom';

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function batch() {
        return $this->belongsTo(Batch::class);
    }
}
