<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['gym_id', 'platform', 'contact'];

    public $timestamps = true;

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    //  Helper Methods
    public function getForGrid()
    {
        return QueryBuilder::for(Contact::class)
            ->allowedFilters([
                AllowedFilter::exact('platform'),
            ])
            ->get();
    }
}
