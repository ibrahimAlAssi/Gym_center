<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\WishList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $cast = [
        'price' => 'decimal:2',
    ];

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function WishLists(): HasMany
    {
        return $this->hasMany(WishList::class);
    }
}
