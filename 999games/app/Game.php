<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User', 'user_games')->withPivot('score');
    }

    public function players()
    {
        return $this->hasMany(UserGames::class, 'game_id');
    }
}
