<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'title'     => $faker->realText(20),
        'content'   => $faker->realText,
        'user_id'   => User::all()->random(),
        'image_url' => $faker->imageUrl()
    ];
});
