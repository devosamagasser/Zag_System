<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        
        $this->app->bind(
            'App\Interfaces\MembersInterface',
            'App\Repositories\MembersRepository',
        );

$this->app->bind(
            'App\Interfaces\PositionsInterface',
            'App\Repositories\PositionsRepository',
        );

        $this->app->bind(
            'App\Interfaces\CommitteesInterface',
            'App\Repositories\CommitteesRepository',
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
