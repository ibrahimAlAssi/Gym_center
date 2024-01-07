<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $table = 'gym';

    protected $fillable = ['name', 'location', 'description'];

    public $timestamps = true;

    public function contact_info()
    {
        return $this->hasMany('Contact_info', 'gym_id');
    }

    public function works()
    {
        return $this->hasMany('Work', 'gym_id');
    }
}
