<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserGames extends Model
{
    protected $fillable = [
        'score'
    ];

    /*
     * To get an user's total points
     */
    public function scopeUserTotalPoints($query, $user_id)
    {
        return $query->where('user_id', $user_id)->sum('score');
    }

    /*
     * To get 128 players sorted DESCENDING by the 'Score' column
     */
    public function scopeHighScoreUsers($query)
    {
        return $query->take(2)->orderBy('score', 'desc')->get();
    }

    /*
     * To get a game's total points
     */
    public function scopeGameTotalPoints($query, $game_id)
    {
        return $query->where('game_id', $game_id)->sum('score');
    }

    public function games()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
