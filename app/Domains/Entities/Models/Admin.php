<?php

declare(strict_types=1);

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\QueryBuilder\QueryBuilder;

class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia,Notifiable;
    use HasRoles;

    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'name',
        'email',
        'password',
        'phone',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    // Start Helper Function
    public function getForGrid()
    {
        return QueryBuilder::for(Admin::class)
            ->allowedFilters(['name'])
            ->get();
    }

    public function findByEmail(string $email): ?Admin
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }
}
