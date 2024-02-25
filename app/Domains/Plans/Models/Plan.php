<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $table = 'plans';

    public $timestamps = true;

    protected $fillable = [
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
}
