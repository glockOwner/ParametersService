<?php

namespace App\Providers;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\ParameterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            RepositoryInterface::class,
            ParameterRepository::class
        );
    }
}
