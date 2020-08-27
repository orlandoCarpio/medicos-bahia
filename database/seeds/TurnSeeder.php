<?php

use Illuminate\Database\Seeder;

class TurnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach(App\Doctor::select('id')->cursor() as $r){
            $array=array();
           $array['id']=$r->id;
            factory('App\Turn',4)->create($array);
        }
        
    
    }
}
