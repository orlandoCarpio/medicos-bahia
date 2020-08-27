<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        //
        'dni'=>$faker->numberBetween(9999999, 100000000),
        'nombre'=>$faker->firstName($gender ='male'|'female'),
        'apellido'=>$faker->lastName,
        'fecha_nac'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'domicilio'=>$faker->cityPrefix.','.$faker->streetName.','.$faker->buildingNumber,
        'tipo'=>$faker->randomElement($array = array ('medico','paciente')),
        'telefono'=>$faker->numberBetween($min = 9999, $max = 1000000),
        'login_id'=>$faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});
