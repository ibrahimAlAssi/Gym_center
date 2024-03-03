<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Healthy_detail extends Model
{
    use HasFactory;
    protected $table = 'healthy_details';

    public $timestamps = true;
}
