<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'gym_id',
    ];

    protected $cast = [
        'price' => 'decimal:2',
    ];

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
