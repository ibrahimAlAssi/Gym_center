<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DietFood extends Model
{
    use HasFactory;

    protected $table = 'diet_food';

    protected $fillable = [
        'diet_id',
        'food_id',
        'allowed_food',
    ];

    protected $cast = [
        'allowed_food' => 'boolean',
    ];

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
