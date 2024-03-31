<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'gym_id',
        'player_id',
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

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    // Start Helper Function
    public function getForGrid(?int $playerId = null)
    {
        return QueryBuilder::for(Feedback::class)
            ->allowedFilters(['is_complaint'])
            ->select([
                'feedbacks.id',
                'feedbacks.message',
                'feedbacks.is_complaint',
                'players.id as player_id',
                'players.name as player_name',
            ])
            ->join('players', 'players.id', '=', 'feedbacks.player_id')
            ->when($playerId != null, fn () => $this->where('player_id', $playerId))
            ->paginate(request()->get('per_page'));
    }
}
