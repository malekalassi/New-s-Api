<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->word ,
        'content'=>$faker->sentence ,
        'written_date'=>$faker->dateTime ,
        'featured_image'=>$faker->imageUrl(),
        'voted_up'=>$faker->numberBetween(1 ,100),
        'voted_down'=>$faker->numberBetween(1 ,100),
        'user_id'=>$faker->numberBetween(1 ,50),
        'category_id'=>$faker->numberBetween(1 ,15),




    ];
});
