<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user = DB::table('users')->where('name', 'admin')->first();
        if (empty($user)) {
            $now = \Carbon\Carbon::now();
            DB::table('users')->insert([
                    [
                        'name' => 'admin',
                        'handle_name' => 'admin',
                        'email' => 'admin@test.com',
                        'password' => \Hash::make('test'),
                        'admin_flg' => 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                ]

            );
        }
	}
}
