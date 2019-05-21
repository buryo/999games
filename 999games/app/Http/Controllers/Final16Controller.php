<?php

namespace App\Http\Controllers;

use App\UserGames;
use App\Http\Controllers\Controller;

class Final16Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = UserGames::with('games', 'users')
            ->whereHas('games', function ($query) {
                $query->where('round_id', '=', 4);
            })
            ->get()->sortBy('users.points');

        $player4points = collect();
        $player5points = collect();
        $player6points = collect();
        $player7points = collect();
        $player8points = collect();
        $player9points = collect();
        $player10points = collect();
        $player11points = collect();
        $player12points = collect();
        $player13points = collect();
        $player14points = collect();
        $player15points = collect();
        $player16points = collect();
        $player17points = collect();
        $player18points = collect();
        $player20points = collect();
        foreach ($players as $player) {
            switch ($player->users->points) {
                case 4:
                    $player4points->push($player);
                    break;
                case 5:
                    $player5points->push($player);
                    break;
                case 6:
                    $player6points->push($player);
                    break;
                case 7:
                    $player7points->push($player);
                    break;
                case 8:
                    $player8points->push($player);
                    break;
                case 9:
                    $player9points->push($player);
                    break;
                case 10:
                    $player10points->push($player);
                    break;
                case 11:
                    $player11points->push($player);
                    break;
                case 12:
                    $player12points->push($player);
                    break;
                case 13:
                    $player13points->push($player);
                    break;
                case 14:
                    $player14points->push($player);
                    break;
                case 15:
                    $player15points->push($player);
                    break;
                case 16:
                    $player16points->push($player);
                    break;
                case 17:
                    $player17points->push($player);
                    break;
                case 18:
                    $player18points->push($player);
                    break;
                case 20:
                    $player20points->push($player);
                    break;
            }
        }
        $player4points->sortByDesc('weight');
        $player5points->sortByDesc('weight');
        $player6points->sortByDesc('weight');
        $player7points->sortByDesc('weight');
        $player8points->sortByDesc('weight');
        $player9points->sortByDesc('weight');
        $player10points->sortByDesc('weight');
        $player11points->sortByDesc('weight');
        $player12points->sortByDesc('weight');
        $player13points->sortByDesc('weight');
        $player14points->sortByDesc('weight');
        $player15points->sortByDesc('weight');
        $player16points->sortByDesc('weight');
        $player17points->sortByDesc('weight');
        $player18points->sortByDesc('weight');
        $player20points->sortByDesc('weight');

        $game = collect();
        foreach ($player4points as $points4) {
            $game->push($points4);
        }
        foreach ($player5points as $points5) {
            $game->push($points5);
        }
        foreach ($player6points as $points6) {
            $game->push($points6);
        }
        foreach ($player7points as $points7) {
            $game->push($points7);
        }
        foreach ($player8points as $points8) {
            $game->push($points8);
        }
        foreach ($player9points as $points9) {
            $game->push($points9);
        }
        foreach ($player10points as $points10) {
            $game->push($points10);
        }
        foreach ($player11points as $points11) {
            $game->push($points11);
        }
        foreach ($player12points as $points12) {
            $game->push($points12);
        }
        foreach ($player13points as $points13) {
            $game->push($points13);
        }
        foreach ($player14points as $points14) {
            $game->push($points14);
        }
        foreach ($player15points as $points15) {
            $game->push($points15);
        }
        foreach ($player16points as $points15) {
            $game->push($points15);
        }
        foreach ($player17points as $points15) {
            $game->push($points15);
        }
        foreach ($player18points as $points15) {
            $game->push($points15);
        }
        foreach ($player20points as $points15) {
            $game->push($points15);
        }

        $game->slice(0, 16);
        return view('rounds.finalscoreboard', compact('game'));
    }
}
