<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\BuscaCnpjRepositoryInterface;
use App\Repositories\BuscaDados\BuscaCnpjRepository;

class BuscaDadosServiceProvider extends ServiceProvider
{

    public function register(): void
    {
       $this->app->bind( abstract: BuscaCnpjRepositoryInterface::class, concrete:BuscaCnpjRepository::class );
    }

    public function boot(): void
    {

    }
}
