<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use App\Src\Shared\Traits\FilterByGym as TraitsFilterByGym;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;
    use HasRoles, TraitsFilterByGym;

    protected $table = 'coaches';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'name',
        'email',
        'password',
        'phone',
        'description',
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

    // Start Helper Function
    public function getForGrid()
    {
        return QueryBuilder::for(Coach::class)
            ->allowedFilters(['name'])
            ->get();
    }

    public function findByEmail(string $email): ?Coach
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }

    public function registerMediaConversions(Media $media = null): void
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
}
