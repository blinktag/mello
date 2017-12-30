<?php

use Faker\Generator as Faker;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name'    => "Tasks for {$faker->name}"
    ];
});
