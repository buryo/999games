<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaderboardController extends Controller
{
    public function index()
    {
        //$users = User::all()->take(10);
        //$user1 = $users[0]->games()->get();
        //dd($user1->first()->pivot->weight);
        return view("leaderboard");
    }

    public function leaderboardData(Request $request)
    {
        $users = User::all()->take(10);

        if($request->ajax()){
            return response()->json($users);
        }

        return view('back/admin/users/index');
    }

    /*
     *
     */
    public function leaderboardSearch(User $user, Request $request)
    {
        $users = User::take(10)->where('name', 'like', '%'. $request->input('firstName') .'%')->get();

        if($request->ajax()){
            return response()->json($users);
        }
    }
}
