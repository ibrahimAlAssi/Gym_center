<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';

    public $timestamps = true;

    public function nutritionalValues()
    {
        return $this->hasMany(NutritionalValue::class, 'food_id');
    }
}
