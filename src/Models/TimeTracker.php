<?php

namespace Onsite\Tracker\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTracker extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
