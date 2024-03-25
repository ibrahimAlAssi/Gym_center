<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    public $timestamps = true;

    protected $fillable = [
        'player_id',
        'day',
        'is_complete',
    ];

    protected $cast = [
        'complete' => 'boolean',
    ];

    public function scheduleTasks(): HasMany
    {
        return $this->hasMany(ScheduleTask::class);
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'schedule_task');
    }
}
