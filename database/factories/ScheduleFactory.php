<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $u=App\Person::select('id')->where('tipo','=','medico')->get();
    $d=$u->count();
    // foreach ($u as $s) {
    //     $d[]=$s['id'];
    // }
    return [
        'dia'=>$faker->randomElement(array(1,2,3,4,5,6)),
        'hora_entrada_M'=>$faker->randomElement(array('08:00','09:00')),
        'hora_entrada_T'=>$faker->randomElement(array('14:00','15:00','16:00')),
        'hora_salida_M'=>$faker->randomElement(array('12:00','13:00')),
        'hora_salida_T'=>$faker->randomElement(array('19:00','20:00')),
        'office_id'=>$faker->numberBetween($min = 1, $max = $d),//randomElement($d),
    ];
});
