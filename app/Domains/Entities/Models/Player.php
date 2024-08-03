<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Cart;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\OrderDiet;
use App\Domains\Operations\Models\Wallet;
use App\Domains\Tasks\Models\Rate;
use App\Domains\Tasks\Models\Schedule;
use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\QueryBuilder\QueryBuilder;

class Player extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;

    protected $table = 'players';

    public $timestamps = true;

    protected $fillable = [
        'diet_id',
        'coach_id',
        'wallet_id',
        'name',
        'email',
        'password',
        'phone',
        'active',
        'gender',
        'attendance_days',
        'birthday',
    ];

    protected $casts = [
        'password' => 'hashed',
        'active' => 'boolean',
        'attendance_days' => 'integer',
        'birthday' => 'date',
    ];

    protected $hidden = [
        'password',
    ];

    public static function booted()
    {
        static::creating(function ($player) {
            DB::transaction(function () use ($player) {
                $wallet = Wallet::create([
                    'available' => 0,
                    'pending' => 0,
                ]);
                $player->wallet_id = $wallet->id;
            });
        });
    }

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function orderDiets(): HasMany
    {
        return $this->hasMany(OrderDiet::class);
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    // Start Helper Function
    public function findByEmail(string $email): ?Player
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }

    public static function findById(string $id): ?Player
    {
        return self::query()
            ->where('id', $id)
            ->first();
    }

    public function getForGrid()
    {
        return QueryBuilder::for(Player::class)
            ->allowedFilters([
                'players.name',
                'coaches.id',
                'coaches.name',
            ])
            ->select([
                'players.id',
                'players.diet_id',
                'players.name',
                'players.email',
                'players.phone',
                'players.gender',
                'players.birthday',
                'coaches.id as coach_id',
                'coaches.name as coach_name',
                'wallets.id as wallet_id',
                'wallets.total',
                'wallets.pending',
                'wallets.available',
            ])
            ->leftJoin('coaches', 'coaches.id', '=', 'players.coach_id')
            ->leftJoin('diets', 'diets.id', '=', 'players.diet_id')
            ->leftJoin('wallets', 'wallets.id', '=', 'players.wallet_id')
            ->paginate(request()->get('per_page'));
    }
}
