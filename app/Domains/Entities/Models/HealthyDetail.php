<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthyDetail extends Model
{
    protected $table = 'healthy_details';

    public $timestamps = true;

    protected $fillable = [
        'player_id',
        'description',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
