<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        $user_role = Role::findByName('user');

        if(!$user_role->hasAnyPermission(['1','4','12','16'])){
            $user_role->givePermissionTo('1','4','12','16');
        }

        app()->setLocale('sl');
    }
}
