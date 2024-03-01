<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Cart;
use App\Domains\Club\Models\Gym;
use App\Domains\Plans\Models\Subscribe;
use App\Domains\Tasks\Models\Rate;
use App\Domains\Tasks\Models\Schedule;
use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    protected $table = 'players';

    public $timestamps = true;

    protected $fillable = [
        'gym_id',
        'diet_id',
        'name',
        'email',
        'password',
        'phone',
        'active',
        'gender',
        'attendance_days',
    ];

    protected $cast = [
        'password' => 'hashed',
        'active' => 'boolean',
        'gender' => 'boolean',
        'attendance_days' => 'integer',
    ];

    protected $hidden = [
        'password',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function healthyDetail(): HasOne
    {
        return $this->hasOne(HealthyDetail::class);
    }

    public function subscribe(): HasMany
    {
        return $this->hasMany(Subscribe::class);
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

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}