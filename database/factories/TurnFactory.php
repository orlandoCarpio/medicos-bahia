<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Turn;
use Faker\Generator as Faker;

$factory->define(Turn::class, function (Faker $faker,$array) {
    $u=App\User::select('id')->get();
    $d=array();
    foreach ($u as $s) {
        $d[]=$s['id'];
    }
    //$u=$u->toArray();
    return [
        'fecha'=>'2020-08-'.$faker->dayOfMonth($max = 31),//$faker->numberBetween($min = 1, $max =31),
        'hora'=>$faker->numberBetween($min = 9, $max =22).':00:00',
        'tipo'=>$faker->randomElement($arrays = array ('atencion','consulta')),
        'estado'=>$faker->randomElement($arrays = array ('atendido','pendiente')),
        'doctor_id'=>$array['id'],
        'user_id'=>$faker->randomElement($arrays = $d),
    ];
});
