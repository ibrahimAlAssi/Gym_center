<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

class Type extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'types';

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getForGrid()
    {
        return QueryBuilder::for(Type::class)
            ->allowedFilters(['name'])
            ->select(['id', 'name'])
            ->with('media')
            ->get();
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
}
