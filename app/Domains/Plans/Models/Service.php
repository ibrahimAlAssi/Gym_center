<?php

namespace App\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'name',
        'description',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}
