<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';

    public $timestamps = true;

    public function nutritional_values()
    {
        return $this->hasMany('App/Domains/Club/Models\Nutritional_value', 'food_id');
    }
}
