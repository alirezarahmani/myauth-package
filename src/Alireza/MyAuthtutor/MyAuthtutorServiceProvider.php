<?php namespace Alireza\MyAuthtutor;

use Illuminate\Support\ServiceProvider;

class MyAuthtutorServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('alireza/MyAuthtutor');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['MyAuth'] = $this->app->share(function($app)
        {
            return new MyAuth;
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('MyAuth', 'Alireza\MyAuthtutor\Facades\MyAuth');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return 'MyAuthtutor';
    }

}
