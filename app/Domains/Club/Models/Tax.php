<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'taxes';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'value',
    ];

    protected $cast = [
        'value' => 'decimal:2',
    ];
}
