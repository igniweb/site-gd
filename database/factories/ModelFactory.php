<?php

$factory->define(App\Models\User::class, function ($faker) {
    $roles = array_keys(trans('app.roles'));

    return [
        'role' => $roles[rand(0, count($roles) - 1)],
        'email' => mb_strtolower($faker->email),
        'password' => app('hash')->make(str_random(10)),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
