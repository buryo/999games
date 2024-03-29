<?php

namespace App\Http\Controllers;

use App\User;
use App\UserGames;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Gets all games a user played in and its scores, Then shows the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserProfile(User $user)
    {
        $battles = collect();
        $matchPoints = [];
        $gamesPlayed = UserGames::where("user_id", $user->id)->get();

        foreach ($gamesPlayed as $gamePlayed) {
            $battleData = UserGames::where("game_id", $gamePlayed->game_id)->get();
            $points = 0;
            foreach ($battleData as $userGame) {
                $points += $userGame->score;
            }
            array_push($matchPoints, $points);
            $battles->push($battleData);
        }

        return view('back/user/profile',  ['user' => $user, "battles" => $battles, "points" => $matchPoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
