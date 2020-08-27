<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(App\Person::where('tipo','=','paciente')->cursor() as $r){
            $array=array();
           $array['id']=$r->id;
            factory('App\User')->create($array);
        }
    }
}
