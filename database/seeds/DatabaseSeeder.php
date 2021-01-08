<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
		[
            'account' => '9',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '9',
        ],
		[
            'account' => 'CPS1',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '3Z2JKYFM6jXF',
        ],
		[
            'account' => 'CPS2',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '9qqu88KY28XR',
        ],
		[
            'account' => 'CPS3',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'DTfmx3B8kKUr',
        ],
		[
            'account' => 'CPS4',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'PBFsCYYfbnZh',
        ],
		[
            'account' => 'CPS5',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'TuJfUEjTAN78',
        ],
		[
            'account' => 'CPS6',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'VKY7MqtpU5eK',
        ],
		[
            'account' => 'CPS7',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'eUYS8zuzxLYE',
        ],
		[
            'account' => 'CPS8',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'njvhskLHwUcK',
        ],
		[
            'account' => 'CPS9',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'stuDxVeFyGCX',
        ],
		[
            'account' => 'CPS10',
            'name' => "管理員",
            'role' => 9,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'zfzGZDjFBwHj',
        ]
		]);

        DB::table('users')->insert([
            'account' => 'cpsguest',
            'name' => "訪客",
            'role' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => 'cpsguest',
        ]);

		/*
        DB::table('users')->insert([
            'account' => '4',
            'name' => "林老師",
            'role' => 4,
            'classroom_id' => 1,
            //'email' => 'twpirls2021@gmail.com',
            'password' => '4',
        ]);
*/
        $cycle_name = (date("yy") - 1911)."1";

        DB::table('cycles')->insert([
            'name' => $cycle_name,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
