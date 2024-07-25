<?php

namespace App\Domains\Plans\Models;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public $timestamps = true;

    protected $fillable = [
        'subscription_id',
        'order_id',
        'player_id',
        'coach_id',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function subscription(): BelongsTo
    {
        return $this->BelongsTo(Subscription::class);
    }

    public function player(): BelongsTo
    {
        return $this->BelongsTo(Player::class);
    }
}
