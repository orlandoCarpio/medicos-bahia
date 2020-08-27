<?php

use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u=App\Person::select('id')->where('tipo','=','medico')->get();
        $d=$u->count();
    
        factory('App\Office',$d)->create();
    }
}
