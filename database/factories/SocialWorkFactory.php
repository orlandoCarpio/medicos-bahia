<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SocialWork;
use Faker\Generator as Faker;

$factory->define(SocialWork::class, function (Faker $faker) {
    return [
        'descripcion'=>$faker->unique()->randomElement(array('Swiss Medical Sa','OSDE','Aca Salud','Osffentos')),
    ];
});
