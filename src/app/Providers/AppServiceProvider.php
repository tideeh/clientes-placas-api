<?php

namespace App\Providers;

use App\Domain\Cliente\Repositories\ClienteRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentClienteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ClienteRepository::class,
            EloquentClienteRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
