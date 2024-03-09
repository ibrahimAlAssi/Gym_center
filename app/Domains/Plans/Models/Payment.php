<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'subscribe_id',
        'player_id',
        'payment_method',
        'transaction_data',
        'transaction_id',
    ];

    public function subscribe(): BelongsTo
    {
        return $this->BelongsTo(Subscribe::class);
    }

    public function player(): BelongsTo
    {
        return $this->BelongsTo(Player::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
