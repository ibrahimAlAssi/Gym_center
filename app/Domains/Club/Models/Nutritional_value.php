<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nutritional_value extends Model
{
    use HasFactory;
    protected $table = 'nutritional_values';

    public $timestamps = true;
}
