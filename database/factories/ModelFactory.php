<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\DhcpEntry::class, function (Faker\Generator $faker) {
    return [
        'mac' => $faker->macAddress,
        'is_disabled' => $faker->boolean(10),
        'is_ssd' => $faker->boolean(10),
        'owner_email' => $faker->email,
        'added_by' => $faker->email,
    ];
});
