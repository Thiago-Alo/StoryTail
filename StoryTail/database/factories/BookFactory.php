<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->randomElement(['A Squash and a Squeeze','Monkey Puzzle','The Colour Monster','The Gruffalo']),
        'summary' => $faker->text(100),
        'author' => $faker->name,
        'illustrator' => $faker->name,
        'age_group_id'=> random_int(1,5),
    ];
});
