<?php

use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => str_random(10),
            'type' => 'buddy',
            'first_name' => 'buddy first',
            'last_name' => 'buddy last',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);
    }
}
