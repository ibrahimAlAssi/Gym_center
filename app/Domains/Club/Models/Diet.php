<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diet extends Model
{
    use HasFactory;

    protected $table = 'diets';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'is_free',
    ];

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'Diet_food');
    }

    public function DietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'Diet_food');
    }
}
