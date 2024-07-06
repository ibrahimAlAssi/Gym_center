<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class Work extends Model
{
    use HasFactory;

    protected $table = 'works';

    public $timestamps = true;

    protected $fillable = [
        'day',
        'man',
        'woman',
        'day',
    ];

    protected $cast = [
        'is_working' => 'boolean',
    ];

    public function getForGrid()
    {
        return QueryBuilder::for(Work::class)
            ->select([
                'works.id',
                'works.day',
                'works.man',
                'works.woman',
            ])
            ->get();
    }
}
