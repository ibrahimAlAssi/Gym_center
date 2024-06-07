<?php

namespace App\Domains\Plans\Models;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    public $timestamps = true;

    protected $fillable = [
        'player_id',
        'plan_id',
        'coach_Id',
        'offer_id',
        'cost',
        'description',
        'start_date',
        'end_date',
        'closet_number',
    ];

    protected $cast = [
        'cost' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function plan(): BelongsTo
    {
        return $this->BelongsTo(Plan::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getForGrid(?int $playerId = null)
    {
        return QueryBuilder::for(Subscription::class)
            ->allowedFilters([
                AllowedFilter::exact('players.name'),
                AllowedFilter::exact('plans.name'),
                AllowedFilter::exact('plans.type'),
            ])
            ->select([
                'subscriptions.id',
                'subscriptions.cost',
                'subscriptions.description',
                'coaches.id as coach_id',
                'coaches.name as .coach_name',
                'players.id as player_id',
                'players.name as player_name',
                'plans.id as plan_id',
                'plans.name as plan_name',
                'plans.type as plan_type',
            ])
            ->join('players', 'players.id', '=', 'subscriptions.player_id')
            ->leftJoin('coaches', 'coaches.id', '=', 'subscriptions.coach_id')
            ->leftJoin('plans', 'plans.id', 'subscriptions.plan_id')
            ->when($playerId != null, fn ($query) => $query->where('player_id', $playerId))
            ->paginate(request()->get('per_page'));
    }
}
