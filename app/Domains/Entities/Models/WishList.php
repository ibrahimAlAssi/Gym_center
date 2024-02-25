<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishList extends Model
{
    protected $table = 'Wish_lists';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'player_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
