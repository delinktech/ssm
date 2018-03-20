<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
  static $password;
  return [
    'first_name' => $faker->firstName,
    'teacher_surname' => $faker->lastName,
    'teacher_id_number' => $faker->numberBetween(1-10),
    'teacher_email' => preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail),
    'teacher_dev_reg' => str_random(10),
    'teacher_api_session' => str_random(16),
    'teacher_password' => $password ?: $password = bcrypt('secret'),
    'teacher_status' => $faker->numberBetween(1-5),
    'teacher_school_id' => $faker->numberBetween(1-5),
    'teacher_user_id' => $faker->numberBetween(1-5),
    'teacher_code' => $faker->unique()->text(5)
  ];
});
