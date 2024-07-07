<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('sm')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('md')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('lg')
            ->width(500)
            ->height(500);
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
                'products.quantity',
            ])
            ->with('media')
            ->paginate(request()->get('per_page'));
    }
}
