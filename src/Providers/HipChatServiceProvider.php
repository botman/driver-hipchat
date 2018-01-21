<?php

namespace BotMan\Drivers\HipChat\Providers;

use Illuminate\Support\ServiceProvider;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\HipChat\HipChatDriver;
use BotMan\Studio\Providers\StudioServiceProvider;

class HipChatServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->isRunningInBotManStudio()) {
            $this->loadDrivers();

            $this->publishes([
                __DIR__.'/../../stubs/hipchat.php' => config_path('botman/hipchat.php'),
            ]);

            $this->mergeConfigFrom(__DIR__.'/../../stubs/hipchat.php', 'botman.hipchat');
        }
    }

    /**
     * Load BotMan drivers.
     */
    protected function loadDrivers()
    {
        DriverManager::loadDriver(HipChatDriver::class);
    }

    /**
     * @return bool
     */
    protected function isRunningInBotManStudio()
    {
        return class_exists(StudioServiceProvider::class);
    }
}
