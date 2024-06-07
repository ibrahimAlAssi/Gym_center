<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

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
