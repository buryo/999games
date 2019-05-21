<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'table' => $faker->numberBetween($min = 1, $max = 32),
        'round_id' => $faker->numberBetween($min = 1, $max = 2),
    ];
});
