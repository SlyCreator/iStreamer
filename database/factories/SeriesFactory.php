<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'description' => $faker->text(200),
        'year' =>  (string)$faker->year
    ];
});
