<?php

namespace App\Http\Controllers\Auth;

use App\Login;
use App\Http\Controllers\Controller;
use App\participant;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'min:3', 'string', 'max:15', 'unique:users'],
            'name' => ['required', 'min:3', 'string', 'max:55'],
            'last_name' => ['required', 'min:3', 'string', 'max:55'],
            'email' => ['required', 'min:3', 'string', 'email', 'max:100', 'unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $totalPlayers = count(participant::all());

        if ($totalPlayers > 128 ) {
            Session::flash('message', "Succesvol geregistreerd, Je staat op de reserve lijst.");
            Session::flash('alert-class', 'alert-warning');
        }
        else {
            Session::flash('message', 'Succesvol geregistreerd!');
            Session::flash('alert-class', 'alert-success');
        }

        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);
    }
}
