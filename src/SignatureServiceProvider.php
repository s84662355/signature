<?php
/**
 * Created by PhpStorm.
 * User: chenjiahao
 * Date: 2019-05-29
 * Time: 09:54
 */

namespace CustomRabbitmq;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class SignatureServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'signature-config');
        }

        $this->app->singleton(
            'signature',
            function (){
                return new Loulance(config('signature.check'),config('signature.client'));
            }
        );
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    { 
         app('router')->aliasMiddleware('signature', Middleware::class);
    }

}
