<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
}
