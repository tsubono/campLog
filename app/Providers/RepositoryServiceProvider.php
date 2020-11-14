<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\CampSchedule\CampScheduleRepositoryInterface::class,
            \App\Repositories\CampSchedule\CampScheduleRepository::class
        );

        $this->app->bind(
            \App\Repositories\CampPlace\CampPlaceRepositoryInterface::class,
            \App\Repositories\CampPlace\CampPlaceRepository::class
        );

        $this->app->bind(
            \App\Repositories\AccessToken\AccessTokenRepositoryInterface::class,
            \App\Repositories\AccessToken\AccessTokenRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
