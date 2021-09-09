<?php

namespace App\Providers;

use App\Models\Diaria;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('tipo-cliente', function (User $user) {
            return $user->tipo_usuario == 1;
        });

        Gate::define('dono-diaria', function (User $user, Diaria $diaria) {
            if ($user->tipo_usuario == 1) {
                return $diaria->cliente_id === $user->id;
            }

            return true;
        });
    }
}
