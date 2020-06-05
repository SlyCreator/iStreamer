<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'title'=> $faker->text(20),
        'description'=>$faker->text(200),
        'series_id' => 1
    ];
});
