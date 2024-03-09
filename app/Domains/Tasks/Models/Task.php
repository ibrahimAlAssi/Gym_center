<?php

namespace App\Domains\Tasks\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'type_id',
        'name',
        'number',
        'description',
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
}
