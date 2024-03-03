<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionalValue extends Model
{
    use HasFactory;
    protected $table = 'nutritional_values';

    public $timestamps = true;

    protected $fillable = [
        'food_id',
        'name',
        'value',
    ];

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
