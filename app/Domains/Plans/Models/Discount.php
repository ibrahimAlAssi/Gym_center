<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';

    public $timestamps = true;
}
