<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    protected $table = 'offers';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'start_date',
        'end_date',
        'type',
        'value',
        'extra_date',
    ];

    protected $cast = [
        'start_date' => 'date',
        'end_date' => 'date',
        'extra_date' => 'date',
        'type' => 'boolean',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
