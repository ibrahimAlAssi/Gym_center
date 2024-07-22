<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    public $timestamps = true;

    protected $fillable = [
        'plan_id',
        'start_date',
        'end_date',
        'value',
    ];

    protected $casts = [
        'value' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function getForGrid(?bool $active = false)
    {
        return QueryBuilder::for(Discount::class)
            ->allowedFilters([
                'discounts.start_date',
                'discounts.end_date',
            ])
            ->select([
                'discounts.id',
                'discounts.start_date',
                'discounts.end_date',
                'discounts.value',
                'plans.id as plan_id',
                'plans.name as plan_name',
            ])
            ->join('plans', 'plans.id', '=', 'discounts.plan_id')
            ->when($active === true, fn ($query) => $query->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now()))
            ->paginate(request()->get('per_page'));
    }

    public function findActiveDiscountByPlan(int $planId)
    {
        return Discount::select(['id', 'value'])
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where('plan_id', $planId)
            ->orderBy('id', 'desc')
            ->first();
    }
}
