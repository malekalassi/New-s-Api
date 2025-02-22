<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content'=>$faker->text ,
        'written_date'=>$faker->dateTime('now'),
        'user_id'=>$faker->numberBetween(1 , 50),
        'post_id'=>$faker->numberBetween(1 , 500),

    ];
});
