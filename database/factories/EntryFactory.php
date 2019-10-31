<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use App\User;
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

$factory->define(Entry::class, function (Faker $faker) {
    $users = User::all();
    return [
        'title'     => $faker->realText(20),
        'content'   => $faker->realText,
        'user_id'   => $users->random(),
        'image_url' => $faker->imageUrl() ?? "https://loremflickr.com/240/240"
    ];
});
