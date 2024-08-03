<?php

namespace App\Domains\Plans\Models;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

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
        'payment_type',
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

    public function getForGrid(?int $coachId = null, ?int $playerId = null)
    {
        return QueryBuilder::for(Payment::class)
            ->select([
                'payments.id',
                'payments.subscription_id',
                'payments.order_id',
                'payments.total',
                'payments.created_at',
                'plans.name as plan_name',
                'plans.cost as plan_cost',
            ])
            ->leftJoin('subscriptions', 'subscriptions.id', '=', 'payments.subscription_id')
            ->leftJoin('plans', 'plans.id', '=', 'subscriptions.plan_id')
            ->when($coachId != null, fn ($query) => $query->where('payments.coach_id', $coachId))
            ->when($playerId != null, fn ($query) => $query->where('payments.player_id', $playerId))
            ->paginate(request()->get('per_page'));
    }
}
