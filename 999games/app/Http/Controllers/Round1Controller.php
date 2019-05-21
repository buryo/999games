<?php

namespace App\Http\Controllers;

use App\Game;
use App\participant;
use App\UserGames;
use Illuminate\Http\Request;

class Round1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rounds.round1.index');
    }

    /**
     * Store a newly generated round in storage.
     */
    public function store()
    {
        $participants = Participant::limit(128)->where('status', '=', '1')->orderby('created_at')->get();
        $players = $participants->shuffle();

        switch ($players->count() % 4) {
            case 1:
                $customTablesCount = $players->count() - 9;
                $normalUsers = $players->slice(0, $customTablesCount);
                $customTableUsers = $players->slice($customTablesCount);

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
                $customTablesCount = $players->count() - 6;
                $normalUsers = $players->slice(0, $customTablesCount);
                $customTableUsers = $players->slice($customTablesCount);

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
                $tables = $players->chunk(4);
        }

        foreach ($tables as $index => $table) {
            $games = new Game;
            $games->table = $index + 1;
            $games->round_id = 1;
            $games->save();
        }

        $count = count($tables);
        foreach ($tables as $index => $table) {
            foreach ($table as $player) {
                $usergames = new UserGames;
                $usergames->user_id = $player->id;
                $usergames->game_id = ($games->id - ($count - $index)) + 1;
                $usergames->save();
            }
        }
        $generated = true;

        return view('rounds.round1.show', compact(['tables', 'generated']));
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

            return view('rounds.round1.show', compact(['games', 'generated']));
        } else{
            return redirect()->route('round1.index');
        }
    }
}