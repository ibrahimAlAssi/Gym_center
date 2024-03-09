<?php

namespace App\Domains\Tasks\Models;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'rates';

    public $timestamps = true;

    protected $fillable = [
        'task_id',
        'player_id',
        'content',
        'rating',
    ];

    protected $cast = [
        'rating' => 'integer',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
