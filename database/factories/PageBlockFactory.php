<?php

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

$factory->define(Pvtl\VoyagerPageBlocks\PageBlock::class, function (Faker $faker) {
    return [
        'page_id' => 1,
        'type' => 'template',
        'path' => 'content_one_column',
        'data' => [
            'html_content' => '<p>' . $faker->sentence . '</p>'
        ],
        'is_hidden' => false,
        'is_minimized' => false,
        'is_delete_denied' => false,
        'cache_ttl' => 0,
        'order' => 10000,
    ];
});
