<?php

namespace App\Providers;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Gate::define('admin', function (User $user) {

            return $user->accountType->type == 'admin'
                ? Response::allow()
                : Response::deny() ;

                /*: Response::deny();*/
                /*: Response::deny('You must be an administrator');*/
        });

    }
}
