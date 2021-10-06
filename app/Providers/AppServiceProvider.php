<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ConsultaCEP\Providers\ViaCEP;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;
use App\Services\ConsultaCidade\Provedores\Ibge;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ConsultaCEPInterface::class, function ($app) {
            return new ViaCEP;
        });

        $this->app->singleton(ConsultaCidadeInterface::class, function ($app) {
            return new Ibge;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
