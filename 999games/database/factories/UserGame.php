<?php

use Faker\Generator as Faker;

$factory->define(App\UserGames::class, function (Faker $faker) {
    return [
        'game_id' => $faker->numberBetween($min = 1, $max = 32),
        'user_id' => $faker->numberBetween($min = 1, $max = 32),
        'score' => $faker->numberBetween($min = 1, $max = 80),
    ];
});
