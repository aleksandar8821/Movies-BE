<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    $values = collect([
        'Action',
        'Comedy',
        'Drama',
        'Horror',
        'Western',
        'Thriller',
        'Animation',
        'Documentary'
    ]);

    return [
        'name' => $faker->text(80),
        'director' => $faker->name,
        'image_url' => $faker->imageUrl(),
        'duration' => $faker->numberBetween(60, 200),
        'release_date' => $faker->date(),
        'genres' => $values->random(3)
    ];

});
