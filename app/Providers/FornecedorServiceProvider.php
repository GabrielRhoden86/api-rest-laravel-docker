<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\FornecedoresRepositoryInterface;
use App\Repositories\Fornecedores\FornecedorRepository;

class FornecedorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FornecedoresRepositoryInterface::class, FornecedorRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
