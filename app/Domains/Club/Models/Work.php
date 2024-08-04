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
        'gym_id',
        'day',
        'man',
        'woman',
        'day',
    ];

    protected $cast = [
        'is_working' => 'boolean',
    ];

    protected static function booted()
    {
        static::updating(function ($gym) {
            if ($gym->man == null || $gym->man == 'closed') {
                $gym->man = 'CLOSED';
            }
            if ($gym->woman == null || $gym->woman == 'closed') {
                $gym->woman = 'CLOSED';
            }
        });
    }

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
