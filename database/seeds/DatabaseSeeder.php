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
        // $this->call(UserSeeder::class);
		DB::table('users')->insert([
			'account' => 'twpirls2021@gmail.com',
            'name' => "管理員",
			'role' => 99,
			'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '66396688',
        ]);
		
		DB::table('users')->insert([
			'account' => 'twpirls20212@gmail.com',
            'name' => "林老師",
			'role' => 50,
			'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '66396688',
        ]);
    }
}
