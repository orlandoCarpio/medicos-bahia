<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UserSeeder::class);
         $this->call(LoginSeeder::class);
         $this->call(PersonSeeder::class);
         $this->call(OfficeSeeder::class);
         $this->call(SpecialtySeeder::class);
         $this->call(ScheduleSeeder::class);
         $this->call(SocialWorkSeeder::class);
         $this->call(DoctorSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(SocialWorkPersonSeeder::class);
         $this->call(TurnSeeder::class);
    }
}
