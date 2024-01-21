<?php

namespace App\Domains\Club\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class Contact_info extends Model
{
    protected $table = 'contact_infos';
    protected $fillable = ['gym_id', 'platform', 'contact'];

    public $timestamps = true;

    public function gym()
    {
        return $this->belongsTo('App\Domains\Club\Models\Gym');
    }

    //  Helper Methods
    public function getForGrid()
    {
        return QueryBuilder::for(Contact_info::class)
            ->allowedFilters(['platform', 'contact'])
            ->get();
    }
}
