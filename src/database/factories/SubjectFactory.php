<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use App\Subject;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Subject::class, function (Faker $faker) {

    $name = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'name' => $name,
        'dept_id' => function () {
            return Department::all()->random();
        },
        'slug' => Str::slug($name),
        'code' => rand(1000, 9000),
        'credit_hour' => rand(1.0, 3.0)
    ];
});
