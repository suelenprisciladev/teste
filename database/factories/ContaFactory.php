<?php

use Faker\Generator as Faker;

$factory->define(\App\Conta::class, function (Faker $faker) {
    return [
      'id_cliente' => App\Cliente::all(['id'])->random(),
      'saldo' => $faker->randomFloat(2,0,1000),
      'conta' => $faker->unique()->numberBetween($min = 1000, $max = 9999),
      'status' => $faker->boolean()
    ];
});
