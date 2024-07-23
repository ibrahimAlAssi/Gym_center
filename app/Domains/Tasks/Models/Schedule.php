<?php

namespace App\Domains\Tasks\Models;

use Carbon\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getForGrid(?int $coachId = null, ?int $playerId = null)
    {

        $currentDayOfWeek = Carbon::now()->dayOfWeek + 1;
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
            ->when($playerId != null, function ($query) use ($playerId) {
                $query->where('schedules.player_id', $playerId)
                    ->orderBy('is_complete');
            })
            ->when($coachId != null, function ($query) use ($coachId) {
                $query->addSelect([
                    'players.id',
                    'players.name',
                    'players.active',
                    'schedules.is_complete',
                ])
                    ->join('players', 'players.id', '=', 'schedules.player_id')
                    ->where('players.coach_id', $coachId)
                    ->orderBy('schedules.day');
            })
            ->where(function ($query) use ($currentDayOfWeek) {
                $query->where('schedules.day', $currentDayOfWeek);
            })
            ->with('tasks', 'tasks.type:id,name', 'tasks.media')
            ->paginate(request()->get('per_page'));
    }
}
