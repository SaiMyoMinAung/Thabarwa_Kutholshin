<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use Illuminate\Support\Str;
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

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->numberBetween(0, 999999),
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'office_id' => 1,
        'state_region_id' => 1,
        'remember_token' => Str::random(10),
    ];
});
