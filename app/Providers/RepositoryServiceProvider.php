<?php

namespace App\Providers;


use App\Repositories\CheckUPRepository;
use App\Repositories\Interfaces\CheckUPInterface;
use App\Repositories\Interfaces\NewsInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(NewsInterface::class, NewsRepository::class);
        $this->app->bind(CheckUPInterface::class, CheckUPRepository::class);
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
