<?php

namespace App\Domains\Games\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';

    public $timestamps = true;

    public function player_game()
    {
        return $this->hasMany('App/Domains/Games/Models\Player_game', 'game_id');
    }

    public function levels()
    {
        return $this->hasMany('App/Domains/Games/Models\Level', 'game_id');
    }
}
