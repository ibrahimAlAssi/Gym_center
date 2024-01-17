<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gym extends Model
{
    use HasFactory;

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

    public function metaData()
    {
        return $this->query()->select([
            'id',
            'name',
            'description',
            DB::raw('ST_X(location) AS latitude'),
            DB::raw('ST_Y(location) AS longitude'),
        ])->first();

    }
}
