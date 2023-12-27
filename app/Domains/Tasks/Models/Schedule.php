<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $timestamps = true;

    public function schedule_task()
    {
        return $this->hasMany('App\Domains\Tasks\Models\Schedule_task', 'schedule_id');
    }
}
