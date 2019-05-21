<?php

namespace App\Http\Controllers;

use App\Game;
use App\UserGames;
use App\User;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserGamesController extends Controller

{
    //Getting the users corresponding to the given game and returning a view where the scores for those users can set
    public function getPlayers($game)
    {
        $players = UserGames::where('game_id', $game)->get();
        $users = collect();

        foreach ($players as $player) {
            $users = $users->concat(\App\User::where('id', $player->user_id)->get());
        }

        return view('table', ['players' => $users, 'game' => $game]);
    }

    //Validates and sets the scores, points and weight for the users
    public function setScore($game, Request $request)
    {
        //Getting the UserGames for each user playing the same game
        $players = UserGames::where('game_id', $game)->get();

        //Validating the inputs from the view
        foreach ($players as $player) {
            request()->validate([
                'user_' . $player->user_id => ['required', 'integer']
            ]);
        }

        //Getting all the scores and making a total of them
        $scores = array_except($request->request->all(), ['_token']);
        $total = 0;
        foreach ($scores as $id => $score) {
            $total = $total + $score;
        }

        //Saving for every player their score, points and weight
        foreach ($players as $player) {

            //Sorting the scores from highest to lowest score
            arsort($scores);

            //Updating the score of the player to the value given from the view
            UserGames::where('user_id', $player->user_id)->update(['score' => $request["user_$player->user_id"]]);

            //Allocation the right amount of points corresponding to the score earned in the game as well as calculating the weight and saving them
            if ($request["user_$player->user_id"] == current($scores)) {
                User::where('id', $player->user_id)->increment('points', 13);
                UserGames::where('user_id', $player->user_id)->update(['weight' => (current($scores) / $total) * 100]);
            } elseif ($request["user_$player->user_id"] == next($scores)) {
                User::where('id', $player->user_id)->increment('points', 9);
                UserGames::where('user_id', $player->user_id)->update(['weight' => (current($scores) / $total) * 100]);
            } elseif ($request["user_$player->user_id"] == next($scores)) {
                User::where('id', $player->user_id)->increment('points', 5);
                UserGames::where('user_id', $player->user_id)->update(['weight' => (current($scores) / $total) * 100]);
            } else {
                User::where('id', $player->user_id)->increment('points', 1);
                UserGames::where('user_id', $player->user_id)->update(['weight' => (next($scores) / $total) * 100]);
            }
        }
    }
}
