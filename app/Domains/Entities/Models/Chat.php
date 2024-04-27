<?php

namespace App\Domains\Entities\Models;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function getForGrid(?int $playerId = null)
    {
        return QueryBuilder::for(Chat::class)
            ->select([
                'messages.id',
                'messages.message',
                'chats.id',
                'players.id as player_id',
                'players.name as player_name',
            ])
            ->join('players', 'players.id', '=', 'chats.player_id')
            ->join('messages', 'messages.chat_id', '=', 'chats.id')
            ->when($playerId != null, fn () => $this->where('player_id', $playerId))
            ->paginate(request()->get('per_page'));
    }
}
