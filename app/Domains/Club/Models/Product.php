<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'brand',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function getForGrid()
    {
        return QueryBuilder::for(Product::class)
            ->allowedFilters([
                'products.name',
                'products.price',
            ])
            ->select([
                'products.id',
                'products.name',
                'products.price',
                'products.brand',
            ])
            ->with('media')
            ->paginate(request()->get('per_page'));
    }
}
