<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Key::class, function (Faker $faker) {

    $title = ['开锁','关锁'];
    return [
        'title' =>$type=$title[mt_rand(0,1)],
        'type' => $type=='开锁'?'0':'1',
        'time' => date("Y-m-d H:i:s",time()),
    ];
});

