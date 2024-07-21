<?php

namespace App\Domains\Entities\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;
    use HasRoles;

    protected $table = 'coaches';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'specialization',
        'experienceYears',
        'subscribePrice',
        'description',
    ];

    protected $casts = [
        'password' => 'hashed',
        'experienceYears' => 'double',
        'subscribePrice' => 'double',
    ];

    protected $hidden = [
        'password',
    ];

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    // Start Helper Function
    public function getForGrid(?bool $random = false)
    {
        return QueryBuilder::for(Coach::class)
            ->allowedFilters(['name'])
            ->select('coaches.*', DB::raw('COUNT(players.id) AS total_trainers'))
            ->leftJoin('players', 'players.coach_id', '=', 'coaches.id')
            ->groupBy('coaches.id')
            ->when($random, fn ($query) => $query->inRandomOrder())
            ->paginate(request()->get('per_page'));
    }

    public function findByEmail(string $email): ?Coach
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('sm')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('md')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('lg')
            ->width(500)
            ->height(500);
    }

    function getTotalTrainers($coach_id)
    {
        return Player::where('coach_id', $coach_id)->count();
    }
}
