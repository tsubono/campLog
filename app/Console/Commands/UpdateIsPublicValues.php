<?php

namespace App\Console\Commands;

use App\Models\CampSchedule;
use App\Models\User;
use App\Models\UserLink;
use Illuminate\Console\Command;

class UpdateIsPublicValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:is-public-values';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Is Public Values';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::all()->each (function($user) {
           if (is_null($user->is_public_gender)) {
               $user->is_public_gender = 0;
           }
           if (is_null($user->is_public_age)) {
               $user->is_public_age = 0;
           }
           if (is_null($user->is_public_camp_history)) {
               $user->is_public_camp_history = 0;
           }
           if (is_null($user->is_public_location)) {
               $user->is_public_location = 0;
           }
           if (is_null($user->is_public_introduction)) {
               $user->is_public_introduction = 0;
           }
           if (is_null($user->is_public_twitter_url)) {
               $user->is_public_twitter_url = 0;
           }
           if (is_null($user->is_public_instagram_url)) {
               $user->is_public_instagram_url = 0;
           }
           if (is_null($user->is_public_facebook_url)) {
               $user->is_public_facebook_url = 0;
           }
           if (is_null($user->is_public_youtube_url)) {
               $user->is_public_youtube_url = 0;
           }
           if (is_null($user->is_public_blog_url)) {
               $user->is_public_blog_url = 0;
           }
           if (is_null($user->is_public_clubhouse_url)) {
               $user->is_public_clubhouse_url = 0;
           }
            $user->save();
        });

        UserLink::all()->each (function($userLink) {
            if (is_null($userLink->is_public)) {
                $userLink->is_public = 0;
            }
            $userLink->save();
        });

        CampSchedule::all()->each (function($campSchedule) {
            if (is_null($campSchedule->is_public)) {
                $campSchedule->is_public = 0;
            }
            $campSchedule->save();
        });
    }
}
