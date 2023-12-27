<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    public $timestamps = true;

    public function schedule_task()
    {
        return $this->hasMany('App\Domains\Tasks\Models\Schedule_task', 'task_id');
    }

    public function types()
    {
        return $this->belongsTo('App\Domains\Tasks\Models\Type', 'type_id');
    }

    public function rate()
    {
        return $this->hasOne('App\Domains\Tasks\Models\Rate', 'task_id');
    }
}
