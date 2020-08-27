<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$c=App\person::where('tipo','=','medico')->select('id')->get();
        
        foreach(App\Person::where('tipo','=','medico')->cursor() as $r){
            $array=array();
           $array['id']=$r->id;
            factory('App\Doctor')->create($array);
        }
        
    }
}
