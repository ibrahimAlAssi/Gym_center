<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;
    protected $table = 'Wish_list';

    public $timestamps = true;
}

