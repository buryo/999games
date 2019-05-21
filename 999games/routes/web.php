<?php

Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/attendance', 'AdminController@attendanceSearch');
Route::post('/attendance/activate/{id}', 'AdminController@attendanceActivate');
Route::post('/attendance/deactivate/{id}', 'AdminController@attendanceDeactivate');
Route::get('/attendance', 'AdminController@attendanceChecklist');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::get('/attendance', 'AdminController@attendanceChecklist')->name('attendance');
    Route::get('/register', 'AdminController@showRegisterForm')->name('user.register');
    Route::post('/register', 'AdminController@register')->name('user.register');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', function () {
    return view('about');
});

Route::resource('user', 'UserController');
Route::get('user/{user}/profile', 'UserController@getUserProfile')->name('user.profile');

Route::resource('round1', 'Round1Controller');
Route::resource('round2', 'Round2Controller');
Route::resource('round3', 'Round3Controller');
Route::resource('round4', 'Round4Controller');
Route::resource('top16', 'Final16Controller');

Route::get('game/{game}', 'UserGamesController@getPlayers')->name('game');
Route::post('game/{game}', 'UserGamesController@setScore')->name('game.setScore');

Route::get('/leaderboard', 'LeaderboardController@index')->name("leaderboard");
Route::post('/leaderboardApi', 'LeaderboardController@leaderboardSearch');
Route::get('/leaderboardApi', 'LeaderboardController@leaderboardData');
