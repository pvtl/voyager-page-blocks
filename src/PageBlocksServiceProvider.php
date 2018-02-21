<?php

namespace Pvtl\VoyagerPageBlocks;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PageBlocksServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services
     *
     * @param Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Defines which files to copy the root project
        $this->publishes([
            __DIR__ . '/../resources' => base_path('resources'),
            __DIR__ . '/database' => base_path('database'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                commands\InstallCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(PageBlocks::class, 'PageBlocks');
    }
}