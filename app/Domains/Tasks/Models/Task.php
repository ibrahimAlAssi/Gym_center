<?php

namespace App\Domains\Tasks\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Task extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'tasks';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'number',
        'description',
        'type',
    ];

    public function scheduleTasks(): HasMany
    {
        return $this->hasMany(ScheduleTask::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function schedule(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class, 'schedule_task');
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    public function getForGrid(?bool $random = false)
    {
        return QueryBuilder::for(Task::class)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('type'),
            ])
            ->when($random, fn ($query) => $query->inRandomOrder())
            ->paginate(request()->get('per_page'));
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
