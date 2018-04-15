<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    return [
        'student_reg' => $faker->unique()->text(10),
        'class_id' => $faker->numberBetween(1-2),
        'student_first_name' => $faker->firstName,
        'student_second_name' => $faker->lastName,
        'student_last_surname' => $faker->name,
        'student_dob' => $faker->date('Y-m-d'),
        'student_gender' => $faker->randomElement(['male', 'female']),
        'student_parent' => $faker->numberBetween(1-2),
        'student_school' => $faker->numberBetween(1-2)
    ];
});
