<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name_company' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'email' => $faker->companyEmail,
        'phone' => $faker->phoneNumber
    ];
});
