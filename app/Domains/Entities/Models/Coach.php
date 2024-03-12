<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Coach extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia,Notifiable;
    use HasRoles;

    protected $table = 'coaches';

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

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    public function findByEmail(string $email): ?Coach
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }
}
