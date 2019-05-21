<?php

namespace App\Http\Controllers;

use App\Game;
use App\UserGames;
use Illuminate\Http\Request;

class Round2Controller extends Controller
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
                $query->where('round_id', '=', 1);
            })
            ->where('score', '=', null)
            ->get();

        if ($players->isNotEmpty()) {
            if ($players->count() > 0) {
                $start_round_2 = false;
            } else {
                $start_round_2 = true;
            }
        } else {
            $start_round_2 = false;
        }

        return view('rounds.round2.index', compact('start_round_2'));
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
                $query->where('round_id', '=', 1);
            })
            ->get()->sortByDesc('users.points');

        $player5points = collect();
        $player3points = collect();
        $player2points = collect();
        $player1points = collect();
        foreach ($players as $player) {
            switch ($player->users->points) {
                case 5:
                    $player5points->push($player);
                    break;
                case 3:
                    $player3points->push($player);
                    break;
                case 2:
                    $player2points->push($player);
                    break;
                case 1:
                    $player1points->push($player);
                    break;
            }
        }
        $player5points->sortByDesc('weight');
        $player3points->sortByDesc('weight');
        $player2points->sortByDesc('weight');
        $player1points->sortByDesc('weight');

        $game = collect();
        foreach ($player5points as $points5) {
            $game->push($points5);
        }
        foreach ($player3points as $points3) {
            $game->push($points3);
        }
        foreach ($player2points as $points2) {
            $game->push($points2);
        }
        foreach ($player1points as $points1) {
            $game->push($points1);
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
            $games->round_id = 2;
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

        return view('rounds.round2.show', compact(['tables', 'generated']));
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

            return view('rounds.round2.show', compact(['games', 'generated']));
        } else{
            return redirect()->route('round2.index');
        }
    }
}