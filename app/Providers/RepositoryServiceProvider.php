<?php

namespace App\Providers;

use App\Repositories\BedTypeRepository;
use App\Repositories\Interfaces\BedTypeInterface;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider for instantiable repositories
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BedTypeInterface::class, BedTypeRepository::class);
    }
}
