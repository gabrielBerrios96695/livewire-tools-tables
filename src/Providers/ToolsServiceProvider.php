<?php

namespace Gambito\LivewireTable\Providers;

use Illuminate\Support\ServiceProvider;
use Gambito\LivewireTable\Commands\MakeToolsTableCommand;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/tools.php', 'tools');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'tools');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/tools.php' => config_path('tools.php'),
            ], 'tools-config');

            $this->commands([
                MakeToolsTableCommand::class,
            ]);
        }
    }
}
