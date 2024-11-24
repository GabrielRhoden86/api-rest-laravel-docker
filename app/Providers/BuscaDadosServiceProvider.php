<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use App\Repositories\Fornecedores\BuscaCnpjRepository;

class BuscaDadosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind( abstract: BuscaCnpjRepositoryInterface::class, concrete: BuscaCnpjRepository::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
