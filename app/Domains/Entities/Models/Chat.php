<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueryBuilder\QueryBuilder;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    public $timestamps = true;

    protected $fillable = ['player_id', 'coach_id'];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    // Start Helper Function
    public function getForGrid(?int $playerId, ?int $coachId)
    {
        return QueryBuilder::for(Chat::class)
            ->allowedFilters([
                'coaches.name',
                'players.name',
            ])
            ->select([
                'chats.id',
                'chats.player_id',
                'chats.coach_id',
                'chats.created_at',
            ])
            ->join('coaches', 'coaches.id', '=', 'chats.coach_id')
            ->join('players', 'players.id', '=', 'chats.player_id')
            ->with(['messages' => function ($query) {
                $query->select('id', 'chat_id', 'message', 'created_at')
                    ->latest('created_at')->take(1);
            }])
            ->when(empty($coachId) == false, function ($query) use ($coachId) {
                $query->where('chats.coach_id', $coachId)
                    ->with(['player' => function ($query) {
                        $query->select([
                            'id',
                            'name',
                        ])->with('media');
                    }]);
            })
            ->when(empty($playerId) == false, function ($query) use ($playerId) {
                $query->where('player_id', $playerId)
                    ->with(['coach' => function ($query) {
                        $query->select([
                            'id',
                            'name',
                        ])->with('media');
                    }]);
            })
            ->paginate(request()->get('per_page'));
    }

    public function findChatByIds(int $playerId, int $coachId)
    {
        return Chat::where('player_id', $playerId)
            ->where('coach_id', $coachId)
            ->first();
    }
}
