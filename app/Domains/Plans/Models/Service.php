<?php

namespace App\Domains\Plans\Models;

use App\Domains\Plans\Models\Plan;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];
    public function plans(): BelongsToMany
    {
        return $this->BelongsToMany(Plan::class);
    }
    public function getForGrid()
    {
        return QueryBuilder::for(Service::class)
            ->allowedFilters([
                AllowedFilter::exact('name'),
            ])
            ->select([
                'services.id',
                'services.name',
                'services.description',
            ])
            ->get();
    }
}
