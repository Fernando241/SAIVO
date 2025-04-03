<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PedidoPagado;
use App\Listeners\EnviarCorreoPedidoPagado;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * 
     * @return void
     */
    public function boot(): void
    {
        Event::listen(
            PedidoPagado::class,
            [EnviarCorreoPedidoPagado::class, 'handle']
        );
    }
}
