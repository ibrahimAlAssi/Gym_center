<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribe';

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
        'closet_number' => 'integer',
    ];

    public function plan(): HasOne
    {
        return $this->hasOne(Plan::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
