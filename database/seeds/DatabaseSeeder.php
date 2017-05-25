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
            'email' => 'buddy1@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'type' => 'businessClient',
            'first_name' => 'buddy first 2',
            'last_name' => 'buddy last 2',
            'email' => 'buddy2@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'type' => 'privateClient',
            'first_name' => 'buddy first 3',
            'last_name' => 'buddy last 3',
            'email' => 'buddy3@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'type' => 'admin',
            'first_name' => 'buddy first 4',
            'last_name' => 'buddy last 4',
            'email' => 'buddy4@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'male',
            'city' => str_random(10),
            'area_id' => 1,
        ]);

    }
}
