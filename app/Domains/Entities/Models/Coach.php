<?php

namespace App\Domains\Entities\Models;

use App\Domains\Operations\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\QueryBuilder\QueryBuilder;

class Coach extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;
    use HasRoles;

    protected $table = 'coaches';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'wallet_id',
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

    public static function booted()
    {
        static::creating(function ($coach) {
            DB::transaction(function () use ($coach) {
                $wallet = Wallet::create([
                    'available' => 0,
                    'pending' => 0,
                ]);
                $coach->wallet_id = $wallet->id;
            });
        });
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

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
            ->allowedFilters([
                'name',
                'specialization',
                'experienceYears',
                'subscribePrice',
            ])
            ->select('coaches.*', DB::raw('COUNT(players.id) AS total_trainers'))
            ->leftJoin('players', 'players.coach_id', '=', 'coaches.id')
            ->groupBy('coaches.id')
            ->with('media')
            ->when($random, fn ($query) => $query->inRandomOrder())
            ->paginate(request()->get('per_page'));
    }

    public function findByEmail(string $email): ?Coach
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }
}
