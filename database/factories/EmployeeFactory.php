<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'city' => $faker->city,
        'salary' => rand(1000, 5000),
        'company_id' => $faker->numberBetween(1, 5)
    ];
});
