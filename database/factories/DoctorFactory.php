<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker,$array) {
    $u=App\Office::select('id')->get();
    $d=array();
     foreach ($u as $s) {
         $d[]=$s['id'];
     }
    return [
        //
        'foto'=>'imagen.jpg',
        'carta_presentacion'=>$faker->text($maxNbChars = 200),
        'person_id'=>$array['id'],
        'specialty_id'=>$faker->randomElement(array(1,2,3)),
        'office_id'=>$faker->unique()->randomElement($array=$d),
    ];

});
