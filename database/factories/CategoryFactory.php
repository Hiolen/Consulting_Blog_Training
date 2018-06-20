<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'update_user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
