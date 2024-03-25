<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribes';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
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
        'closet_number' => 'integer',
    ];

    public function plan(): HasOne
    {
        return $this->hasOne(Plan::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
