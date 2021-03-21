<?php

use Illuminate\Database\Seeder;

class AddLinksSortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// $users = \App\Models\User::query()->whereNull('sort_twitter_url')->get();
		$users = \App\Models\User::query()->get();

		foreach ($users as $user) {
            $user->update([
                'sort_twitter_url' => 1,
                'sort_instagram_url' => 2,
                'sort_youtube_url' => 3,
                'sort_clubhouse_url' => 4,
                'sort_blog_url' => 5,
                'sort_facebook_url' => 6,
            ]);
        }
	}
}
