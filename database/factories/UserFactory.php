<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {

    $api_token = Str::random(10);

    return [
        'name'=>$faker->firstName,
        'email'=>$faker->unique()->safeEmail,
        'password'=>rand(1,999999999),
        'api_token'=> Str::random(10),
    ];
});
