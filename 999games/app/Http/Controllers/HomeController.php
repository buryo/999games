<?php

namespace App\Http\Controllers;

use App\User;
use App\UserGames;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::rankUsers(8);

        return view('home', compact('users'));
    }
}
