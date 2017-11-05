<?php

namespace Smcrow\SlackLog;

use Illuminate\Support\ServiceProvider;
use Smcrow\SlackLog\Services\Logger;

class SlackLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('slack-log.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php',
            'slack-log'
        );

        $this->app->singleton(Logger::class);
    }
}
