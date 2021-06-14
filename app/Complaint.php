<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id', 'complaint_type', 'complaint_description', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
