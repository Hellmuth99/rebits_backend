<?php

namespace App\Providers;

use App\Http\Repositories\Usuarios\UsuariosInterface;
use App\Http\Repositories\Usuarios\UsuariosRepository;
use App\Http\Repositories\Vehiculos\VehiculosInterface;
use App\Http\Repositories\Vehiculos\VehiculosRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(VehiculosInterface::class, VehiculosRepository::class);
        $this->app->bind(UsuariosInterface::class, UsuariosRepository::class);
    }
}
