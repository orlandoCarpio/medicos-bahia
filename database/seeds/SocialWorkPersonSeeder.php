<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialWorkPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a=array();
        $os=App\SocialWork::all();
        $p=App\Person::all();

        foreach ($os as $o) {
            $a[]=$o->id;
        }
        foreach($p as $pe){
           
            if($pe->tipo=='medico'){
                $random_keys=array_rand($a,3);
                foreach ($random_keys as $i) {
                    DB::table('person_social_works')->insert([
                          'person_id'=>$pe->id,
                          'social_work_id'=>$a[$i],
                      ]);    
                  }
            }else{
                $random_keys=array_rand($a,1);
                
                    DB::table('person_social_works')->insert([
                          'person_id'=>$pe->id,
                          'social_work_id'=>$a[$random_keys],
                      ]);    
                  
            }
            
            
            
            
        }
        
    }
}
