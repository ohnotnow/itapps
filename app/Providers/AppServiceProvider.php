<?php

namespace App\Providers;

use Cache;
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
        $dhcpModels = ['App\DhcpEntry', 'App\DhcpSubnet', 'App\DhcpSharedNetwork', 'App\DhcpRange', 'App\DhcpOption'];
        foreach ($dhcpModels as $model) {
            $model::saved(function ($model) {
                Cache::forget('dhcpfile');
            });
            $model::deleted(function ($model) {
                Cache::forget('dhcpfile');
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
