<?php

namespace App\Http\Controllers;

use App\Login;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Resources\Attendance as AttendanceResource;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('back/admin/index');
    }

    public function showRegisterForm()
    {
        return view('back/admin/register/index');
    }

    public function register(Request $request)
    {
        $register = $request->validate([
            'name' => 'required|min:2|string',
            'last_name' => 'required|min:2|string',
            'email' => 'required|unique:login|email|string',
            'password' => 'required|min:6|confirmed|string'
        ]);

        Login::create([
            'name' => $register['name'],
            'last_name' => $register['last_name'],
            'email' => $register['email'],
            'password' => Hash::make($register['password']),
        ]);

        Session::flash('message', 'Account succesvol aangemaakt!');
        Session::flash('alert-class', 'alert-success');

        return back();
    }

    /*
     *
     */
    public function attendanceChecklist(Request $request)
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
    public function attendanceSearch(User $user, Request $request)
    {
        $users = User::take(10)->where('name', 'like', '%'. $request->input('firstName') .'%')->get();

        if($request->ajax()){
            return response()->json($users);
        }
    }

    /*
     *
     */
    public function attendanceActivate(User $user, Request $request, $id)
    {
        User::where('id', $id)->update(array('status' => 1));

        return 'Okay!';
    }

    /*
     *
     */
    public function attendanceDeactivate(User $user, Request $request, $id)
    {
        User::where('id', $id)->update(array('status' => 0));

        return 'Okay!';
    }
}
