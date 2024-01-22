<?php

namespace App\Domains\Club\Models;

use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['gym_id', 'platform', 'contact'];

    public $timestamps = true;

    public function gym()
    {
        return $this->belongsTo('App\Domains\Club\Models\Gym');
    }

    //  Helper Methods
    public function getForGrid()
    {
        return QueryBuilder::for(Contact::class)
            ->allowedFilters(['platform', 'contact'])
            ->get();
    }
}
