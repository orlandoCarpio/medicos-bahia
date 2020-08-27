<?php

use Illuminate\Database\Seeder;

class SocialWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\SocialWork',4)->create();
    }
}
