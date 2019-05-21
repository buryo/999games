<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 250)->create();
        factory('App\Game', 100)->create();
        factory('App\UserGames', 240)->create();
    }
}
