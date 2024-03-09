<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'type',
        'cost',
    ];

    protected $cast = [
        'cost' => 'double',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
