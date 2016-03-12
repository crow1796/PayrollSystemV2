<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
                ->bind('App\Repositories\Eloquent\EmployeeRepository', 'App\Repositories\Eloquent\EmployeeRepository');

        $this->app
                ->when('App\Http\Controllers\EmployeeManagementController')
                ->needs('App\Repositories\Contracts\RepositoryInterface')
                ->give('App\Repositories\Eloquent\EmployeeRepository');
    }
}
