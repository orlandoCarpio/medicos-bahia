<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Office;
use Faker\Generator as Faker;

$factory->define(Office::class, function (Faker $faker) {
    return [
        'barrio'=>$faker->streetName,
        'calle'=>$faker->streetName,
        'numero'=>$faker->numberBetween($min = 1, $max = 900),
        'piso'=>$faker->numberBetween($min = 1, $max = 100),
        'oficina'=>1,
        'telefono'=>$faker->tollFreePhoneNumber,
        'latitud'=>$faker->latitude($min = -90, $max = 90),
        'longitud'=>$faker->longitude($min = -180, $max = 180),
        'intervalo_atencion'=>$faker->randomElement($array = array (20,30,40)),
        'intervalo_consulta'=>$faker->randomElement($array = array (15,20)),
        'tipo_atencion'=>$faker->randomElement($array = array ('consulta','atencion')),
        'ubicacion'=>$faker->address,
    ];
});
