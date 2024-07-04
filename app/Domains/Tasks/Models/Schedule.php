<?php

namespace App\Domains\Tasks\Models;

use Spatie\QueryBuilder\QueryBuilder;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'is_complete' => 'boolean',
    ];

    public function scheduleTasks(): HasMany
    {
        return $this->hasMany(ScheduleTask::class);
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'schedule_task')
            ->withPivot('repeat', 'weight', 'is_complete');
    }

    public function getForGrid(string $entityType, int $id = null)
    {
        if ($entityType === 'player') {
            return QueryBuilder::for(Schedule::class)
                ->allowedFilters([
                    'schedules.day',
                    'schedules.is_complete',
                ])
                ->select([
                    'schedules.id',
                    'schedules.day',
                    'schedules.is_complete as schedule_complete',
                ])
                ->where('schedules.player_id', $id)
                ->with('tasks')
                ->orderBy('is_complete')
                ->paginate(request()->get('per_page'));
        } else {
            return QueryBuilder::for(Player::class)
                ->allowedFilters([
                    'schedules.day',
                    'schedules.is_complete',
                ])
                ->leftJoin('schedules', 'schedules.player_id', '=', 'players.id')
                ->select([
                    'players.id',
                    'players.name',
                    'players.active',
                ])
                ->with('schedules', 'schedules.tasks')
                ->where('players.coach_id', $id)
                ->orderBy('schedules.day')
                ->paginate(request()->get('per_page'));
        }
    }
}
