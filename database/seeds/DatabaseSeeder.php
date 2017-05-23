<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(GeneralSeeder::class);
        DB::table('users')->insert([
            'id' => 1,
            'type' => 'buddy',
            'first_name' => 'buddy first',
            'last_name' => 'buddy last',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'type' => 'communityManager',
            'first_name' => 'buddy first 2',
            'last_name' => 'buddy last 2',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'type' => 'buddy',
            'first_name' => 'buddy first 3',
            'last_name' => 'buddy last 3',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

    }
}
