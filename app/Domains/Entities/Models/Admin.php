<?php

namespace App\Domains\Entities\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Permission\Traits\HasRoles;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = [
        // 'role_id',
        'gym_id',
        'name',
        'email',
        'password',
        'phone',
        'image',
        'description'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo('App\Domains\Entities\Models\Admin');
    }

    public function chats()
    {
        return $this->hasMany('Chat', 'admin_id');
    }

    // Start Helper Function
    public function getForGrid()
    {
        return QueryBuilder::for(Admin::class)
            ->allowedFilters(['name',])
            ->get();
    }

    public function findByEmail(string $email): ?Admin
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }
}
