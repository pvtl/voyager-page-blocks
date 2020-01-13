<?php

namespace Pvtl\VoyagerPageBlocks\Providers;

use Pvtl\VoyagerPageBlocks\Commands;
use Illuminate\Support\ServiceProvider;

class PageBlocksServiceProvider extends ServiceProvider
{
    /**
     * Our root directory for this package to make traversal easier
     */
    const PACKAGE_DIR = __DIR__ . '/../../';

    /**
     * Bootstrap the application services
     *
     * @return void
     */
    public function boot()
    {
        $this->strapRoutes();
        $this->strapPublishers();
        $this->strapViews();
        $this->strapMigrations();
        $this->strapCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge our Scout config over
        $this->mergeConfigFrom(self::PACKAGE_DIR . 'config/scout.php', 'scout.tntsearch.searchableModels');
    }

    /**
     * Bootstrap our Routes
     */
    protected function strapRoutes()
    {
        // Pull default web routes
        $this->loadRoutesFrom(base_path('/routes/web.php'));

        // Then add our package routes
        $this->loadRoutesFrom(self::PACKAGE_DIR . 'routes/web.php');
    }

    /**
     * Bootstrap our Publishers
     */
    protected function strapPublishers()
    {
        // Defines which files to copy the root project
        $this->publishes([
            self::PACKAGE_DIR . 'config/page-blocks.php' => config_path('page-blocks.php'),
        ], 'config');
    }

    /**
     * Bootstrap our Views
     */
    protected function strapViews()
    {
        // Load views
        $this->loadViewsFrom(self::PACKAGE_DIR . 'resources/views', 'voyager-page-blocks');
        $this->loadViewsFrom(self::PACKAGE_DIR . 'resources/views/vendor/voyager', 'voyager');
    }

    /**
     * Bootstrap our Migrations
     */
    protected function strapMigrations()
    {
        // Load migrations
        $this->loadMigrationsFrom(self::PACKAGE_DIR . 'database/migrations');

        // Locate our factories for testing
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            self::PACKAGE_DIR . 'database/factories'
        );
    }

    /**
     * Bootstrap our Commands/Schedules
     */
    protected function strapCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class,
                Commands\SeedCommand::class
            ]);
        }
    }
}
