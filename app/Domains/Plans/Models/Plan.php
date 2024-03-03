<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';

    public $timestamps = true;

    public function services()
    {
        return $this->hasMany('Service', 'service_id');
    }
}
