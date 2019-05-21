<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $fillable = [
        'username', 'name', 'last_name', 'email'
    ];

    public function games()
    {
        return $this->belongsToMany('App\Game', 'user_games')->withPivot('score', 'weight');
    }

    /**
     * @param $query
     * @param $amount to limit
     * @return \Illuminate\Support\Collection
     * Gets $amount(128) players descending by their total score
     */
    public function scopeRankUsers($query, $amount)
    {
        return DB::table('users')
            ->take($amount)
            ->select('username', 'name', 'last_name', 'points')
            ->orderByRaw('points DESC')
            ->get();
    }

    /**
     * @param $query
     * @param $round
     * @return \Illuminate\Support\Collection
     * Gets all players of $round(e.g 1)
     */
    public function scopeGetUsersFromRound($query, $round)
    {
        return DB::table('users')
            ->select('username', 'name', 'games.table','games.round_id', 'points')
            ->join('user_games', 'user_games.user_id', '=', 'users.id')
            ->join('games', 'games.id', '=', 'user_games.game_id')
            ->where('games.round_id', '=', $round)
            ->orderByRaw('user_games.game_id ASC')
            ->get();
    }

    /**
     * @param $query
     * @param $amount to limit
     * @return \Illuminate\Support\Collection
     * Gets $amount(128) players descending by their total score
     */
    public function scopeRankUsersTotalScores($query, $amount)
    {
        return DB::table('users')
            ->take($amount)
            ->join('user_games', 'user_games.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('SUM(user_games.score) as total_Points'))
            ->groupBy('users.name')
            ->orderByRaw('sum(score) DESC')
            ->get();
    }

    /**
     * @param $query
     * @param $letters
     * @return mixed
     * Returns SELECT * FROM users WHERE name LIKE '% $letters %';
     */
    public function scopeNameLike($query, $letters)
    {
        return $query->where('name', 'LIKE', '%'. $letters. '%');
    }

}
