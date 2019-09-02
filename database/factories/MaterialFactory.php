<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'erp_code' => $faker->uuid,
        'name' => $faker->firstName,
        'quantity' => $faker->numberBetween(1,20),
        'origen' => $faker->boolean,
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
    ];
});
