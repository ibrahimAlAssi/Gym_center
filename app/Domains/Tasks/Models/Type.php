<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
