<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pago;
use Faker\Generator as Faker;

$factory->define(Pago::class, function (Faker $faker) {
    return [
        'precio' => $this->faker->randomElement($maxDecimals = 2, $min = 15, $max = 500),
        'pagado' => $this->faker->dateTimeBetween($startData = '-1 year', $endDate = 'now', $timezone = null),
    ];
});
