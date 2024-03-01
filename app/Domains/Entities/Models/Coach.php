<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Coach extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
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
}
