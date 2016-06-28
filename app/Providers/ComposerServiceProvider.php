<?php
/**
 * Created by PhpStorm.
 * User: Jory|jorycn@163.com
 * Date: 2016/6/27
 * Time: 11:47
 */
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            'oauth.grants.partials_create.grants',
            'App\Http\ViewComposers\OAuth\GrantsComposer'
        );
        view()->composer(
            'oauth.scopes.partials_create.scopes',
            'App\Http\ViewComposers\OAuth\ScopesComposer'
        );

        // Using Closure based composers...
        /*view()->composer('dashboard', function ($view) {
            //
        });*/
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}