<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models;

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

$factory->define(Models\BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(5, 10), true);
    $text = $faker->realText(rand(1000, 3000));
    $isPublished = rand(1, 5) > 1;
    $createdAt = $faker->dateTimeBetween('-1 months', '-1 days');
    return [
        'category_id' => rand(1, 11),
        'user_id' => (rand(1, 5) === 5) ? 1 : 2,
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(100),
        'content_raw' => $text,
        'content_html' => $text,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-1 months', '-1 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});
