<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    use HasFactory;

    protected $table = 'works';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'type',
        'day',
        'is_working',
        'from',
        'to',
    ];

    protected $cast = [
        'from' => 'time',
        'to' => 'time',
        'is_working' => 'boolean',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
