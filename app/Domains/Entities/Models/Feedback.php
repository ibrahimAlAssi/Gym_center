<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'player_id',
        'coach_id',
        'message',
        'is_complaint',
    ];

    protected $cast = [
        'is_complaint' => 'boolean',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    // Start Helper Function
    public function getForGrid(?int $playerId = null, ?int $coachId = null)
    {
        return QueryBuilder::for(Feedback::class)
            ->allowedFilters(['is_complaint'])
            ->select([
                'feedbacks.id',
                'feedbacks.message',
                'feedbacks.is_complaint',
                'players.id as player_id',
                'players.name as player_name',
                'coaches.id as coach_id',
                'coaches.name as coach_name',
            ])
            ->leftJoin('players', 'players.id', '=', 'feedbacks.player_id')
            ->leftJoin('coaches', 'coaches.id', '=', 'feedbacks.coach_id')
            ->when($playerId != null, fn () => $this->where('player_id', $playerId))
            ->when($coachId != null, fn () => $this->where('coach_id', $coachId))
            ->paginate(request()->get('per_page'));
    }
}
