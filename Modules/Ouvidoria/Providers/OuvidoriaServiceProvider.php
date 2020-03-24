<?php

namespace Modules\Ouvidoria\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class OuvidoriaServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Ouvidoria', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Ouvidoria', 'Config/config.php') => config_path('ouvidoria.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Ouvidoria', 'Config/config.php'), 'ouvidoria'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/ouvidoria');

        $sourcePath = module_path('Ouvidoria', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/ouvidoria';
        }, \Config::get('view.paths')), [$sourcePath]), 'ouvidoria');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/ouvidoria');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'ouvidoria');
        } else {
            $this->loadTranslationsFrom(module_path('Ouvidoria', 'Resources/lang'), 'ouvidoria');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Ouvidoria', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
