<?php

use Illuminate\Database\Seeder;

/**
 * Class AddEmailVerifiedAtToUsersSeeder
 * 既存のユーザーのメール認証フラグをONにする
 * ※ 1度のみ実行
 */
class AddEmailVerifiedAtToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = \App\Models\User::query()->get();

		foreach ($users as $user) {
            $user->update([
                'email_verified_at' => now(),
            ]);
        }
	}
}
