<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Plan extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'plans';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'type',
        'cost',
    ];

    protected $cast = [
        'cost' => 'double',
    ];

    public function services(): BelongsToMany
    {
        return $this->BelongsToMany(Service::class);
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
        return QueryBuilder::for(Plan::class)
            ->allowedFilters([
                AllowedFilter::exact('name'),
                AllowedFilter::exact('type'),
            ])
            ->select([
                'plans.id',
                'plans.name',
                'plans.type',
                'plans.cost',
                'discounts.id as discount_id',
                'discounts.value as discount_value',
                'discounts.start_date as start_date',
                'discounts.end_date as end_date',
            ])
            ->leftJoin('discounts', function ($query) {
                $query->on('discounts.plan_id', '=', 'plans.id')
                    ->where('discounts.start_date', '<=', now())
                    ->where('discounts.end_date', '>=', now());
            })
            ->with('media')
            ->with('services')
            ->orderBy('plans.id')
            ->get();
    }
}
