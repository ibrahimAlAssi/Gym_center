<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\QueryBuilder\QueryBuilder;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    public $timestamps = true;

    protected $fillable = [
        'chat_id',
        'senderable_id',
        'senderable_type',
        'message',
        'read_at',
    ];

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    // Start Helper Function
    public function getForGrid(int $chatId)
    {
        return QueryBuilder::for(Message::class)
            ->allowedFilters([
                'message',
            ])
            ->select([
                'messages.id',
                'messages.message',
                'messages.created_at',
                'messages.updated_at',
                'messages.senderable_id',
                'messages.senderable_type',
                'chats.id as chat_id',
                'players.id as player_id',
                'players.name as player_name',
            ])
            ->join('chats', 'messages.chat_id', '=', 'chats.id')
            ->join('players', 'players.id', '=', 'chats.player_id')
            ->where('chat_id', $chatId)
            ->paginate(request()->get('per_page'));
    }
}
