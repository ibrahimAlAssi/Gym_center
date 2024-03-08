<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
