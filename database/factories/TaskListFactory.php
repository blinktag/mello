<?php

use Faker\Generator as Faker;

$factory->define(App\TaskList::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
