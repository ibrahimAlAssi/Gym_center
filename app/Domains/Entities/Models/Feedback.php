<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'gym_id',
        'player_id',
        'message',
        'is_complaint',
    ];

    protected $cast = [
        'is_complaint' => 'boolean',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    // Start Helper Function
    public function getForGrid()
    {
        return QueryBuilder::for(Feedback::class)
            ->allowedFilters(['is_complaint'])
            ->get();
    }
}
