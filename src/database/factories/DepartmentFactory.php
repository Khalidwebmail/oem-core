<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Department::class, function (Faker $faker) {

    $name = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'code' => rand(1000, 3000)
    ];
});
