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
        return Chat::with(['messages' => function ($query) {
            $query->select('id', 'chat_id', 'message')
                ->latest('created_at')->take(1); // Get the latest message
        }, 'coach:id,name'])
            ->when($playerId, function ($query, $playerId) {
                return $query->where('player_id', $playerId);
            })
            ->paginate(request()->get('per_page'));
    }
}
