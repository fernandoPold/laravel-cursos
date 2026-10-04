<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\CursoServiceInterface;
use App\Services\CursoService;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra los enlaces del sistema dentro del contenedor IoC.
     */
    public function register(): void
    {
        // Vincula el contrato abstracto con su implementación concreta (DIP). $this->app->bind(CursoServiceInterface::class, CursoService::class); 
        $this->app->bind(CursoServiceInterface::class, CursoService::class);
    }


    /**
     * Ejecuta las configuraciones de arranque del entorno.
     */
    public function boot(): void
    {
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}