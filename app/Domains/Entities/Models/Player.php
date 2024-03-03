<?php

namespace App\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';

    public $timestamps = true;

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }

    public function healthy_details()
    {
        return $this->hasOne('Healthy_detail', 'player_id');
    }

    public function chats()
    {
        return $this->hasMany('Chat', 'chat_id');
    }

    public function lists()
    {
        return $this->hasMany('List', 'list_id');
    }

    public function subscribe()
    {
        return $this->hasMany('Subscribe', 'player_id');
    }

    public function player_game()
    {
        return $this->hasMany('App/Domains/Games/Models\Player_game', 'player_id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Domains\Tasks\Models\Schedule', 'player_Id');
    }

    public function Tasks()
    {
        return $this->hasMany('App\Domains\Tasks\Models\Rate', 'player_id');
    }
}
