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
            'account' => '9',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '9',
        ]);

        DB::table('users')->insert([
            'account' => '4',
            'name' => "林老師",
            'role' => 4,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '4',
        ]);

        $cycle_name = (date("yy") - 1911)."1";

        DB::table('cycles')->insert([
            'name' => $cycle_name
        ]);
    }
}
