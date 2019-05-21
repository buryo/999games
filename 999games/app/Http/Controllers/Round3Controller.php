<?php

namespace App\Http\Controllers;

use App\Game;
use App\UserGames;
use Illuminate\Http\Request;

class Round3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = UserGames::with('games')
            ->whereHas('games', function ($query) {
                $query->where('round_id', '=', 2);
            })
            ->where('score', '=', null)
            ->get();

        if ($players->isNotEmpty()) {
            if ($players->count() > 0) {
                $start_round_3 = false;
            } else {
                $start_round_3 = true;
            }
        } else {
            $start_round_3= false;
        }

        return view('rounds.round3.index', compact('start_round_3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $players = UserGames::with('games', 'users')
            ->whereHas('games', function ($query) {
                $query->where('round_id', '=', 2);
            })
            ->get()->sortBy('users.points');

        $player2points = collect();
        $player3points = collect();
        $player4points = collect();
        $player5points = collect();
        $player6points = collect();
        $player7points = collect();
        $player8points = collect();
        $player10points = collect();
        foreach ($players as $player) {
            switch ($player->users->points) {
                case 2:
                    $player2points->push($player);
                    break;
                case 3:
                    $player3points->push($player);
                    break;
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
                case 10:
                    $player10points->push($player);
                    break;
            }
        }
        $player2points->sortByDesc('weight');
        $player3points->sortByDesc('weight');
        $player4points->sortByDesc('weight');
        $player5points->sortByDesc('weight');
        $player6points->sortByDesc('weight');
        $player7points->sortByDesc('weight');
        $player8points->sortByDesc('weight');
        $player10points->sortByDesc('weight');

        $game = collect();
        foreach ($player2points as $points2) {
            $game->push($points2);
        }
        foreach ($player3points as $points3) {
            $game->push($points3);
        }
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
        foreach ($player10points as $points10) {
            $game->push($points10);
        }

        switch ($game->count() % 4) {
            case 1:
                $customTablesCount = $game->count() - 9;
                $normalUsers = $game->slice(0, $customTablesCount);
                $customTableUsers = $game->slice($customTablesCount);

                $tablesWith4Users = $normalUsers->chunk(4);
                $tablesWith3Users = $customTableUsers->chunk(3);

                $tables = collect();
                foreach ($tablesWith4Users as $tables4) {
                    $tables->push($tables4);
                }

                foreach ($tablesWith3Users as $tables3) {
                    $tables->push($tables3);
                }
                break;
            case 2:
                $customTablesCount = $game->count() - 6;
                $normalUsers = $game->slice(0, $customTablesCount);
                $customTableUsers = $game->slice($customTablesCount);

                $tablesWith4Users = $normalUsers->chunk(4);
                $tablesWith3Users = $customTableUsers->chunk(3);

                $tables = collect();
                foreach ($tablesWith4Users as $tables4) {
                    $tables->push($tables4);
                }

                foreach ($tablesWith3Users as $tables3) {
                    $tables->push($tables3);
                }
                break;
            default:
                $tables = $game->chunk(4);
        }

        foreach ($tables as $index => $table) {
            $games = new Game;
            $games->table = $index + 1;
            $games->round_id = 3;
            $games->save();
        }

        $count = count($tables);
        foreach ($tables as $index => $table) {
            foreach ($table as $player) {
                $usergames = new UserGames;
                $usergames->user_id = $player->users->id;
                $usergames->game_id = ($games->id - ($count - $index)) + 1;
                $usergames->save();
            }
        }
        $generated = true;

        return view('rounds.round3.show', compact(['tables', 'generated']));
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $games = Game::with('players')->where('round_id', '=', $id)->get();
        if ($games->isNotEmpty()) {
            $generated = false;

            return view('rounds.round3.show', compact(['games', 'generated']));
        } else{
            return redirect()->route('round3.index');
        }
    }
}