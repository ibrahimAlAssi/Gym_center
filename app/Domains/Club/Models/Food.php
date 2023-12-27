<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public $timestamps = true;

    public function nutritional_values()
    {
        return $this->hasMany('App/Domains/Club/Models\Nutritional_value', 'food_id');
    }
}
