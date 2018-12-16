<?php

use Faker\Generator as Faker;
use App\Entity\Push;

$factory->define(Push::class, function (Faker $faker) {
    return [
        'repository_name' => sprintf('repository_%s', $faker->numberBetween(1, 3)),
        'pusher' =>  sprintf('user_%s', $faker->numberBetween(1, 12)),
        'pushed_at' => $faker->dateTime(),
        'number_of_commits' => $faker->numberBetween(1, 30),
    ];
});
