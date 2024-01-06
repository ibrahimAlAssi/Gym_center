<?php

namespace App\Domains\Entities\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = ['role_id', 'name', 'phone', 'email', 'description'];

    public function role()
    {
        return $this->belongsTo('App\Domains\Entities\Models\Admin');
    }

    public function chats()
    {
        return $this->hasMany('Chat', 'admin_id');
    }

    // Start Helper Function
    public function findByEmail(string $email): ?Admin
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }
}
