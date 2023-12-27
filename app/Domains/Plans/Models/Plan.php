<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    public $timestamps = true;

    public function services()
    {
        return $this->hasMany('Service', 'service_id');
    }
}
