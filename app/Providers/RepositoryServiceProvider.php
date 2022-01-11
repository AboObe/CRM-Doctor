<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BasicRepositoryInterface;
use App\Repositories\BasicRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BasicRepositoryInterface::class, BasicRepository::class);
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
