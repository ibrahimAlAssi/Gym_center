<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'start_date',
        'end_date',
        'type',
        'value',
    ];

    protected $cast = [
        'start_date' => 'date',
        'end_date' => 'date',
        'type' => 'boolean',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
