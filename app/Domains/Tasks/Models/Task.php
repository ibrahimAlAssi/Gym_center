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
use Spatie\QueryBuilder\QueryBuilder;

class Task extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'tasks';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'url',
        'number',
        'description',
        'type_id',
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
                'types.name',
            ])
            ->select([
                'tasks.id',
                'tasks.name',
                'tasks.number',
                'tasks.url',
                'tasks.description',
                'types.id as type_id',
                'types.name as type_name',
            ])
            ->join('types', 'types.id', '=', 'tasks.type_id')
            ->when($random, fn ($query) => $query->inRandomOrder())
            ->with('media')
            ->paginate(request()->get('per_page'));
    }
}
