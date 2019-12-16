<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MedicalServices;
use Faker\Generator as Faker;

$factory->define(MedicalServices::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->paragraph
    ];
});
