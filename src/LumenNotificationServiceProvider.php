<?php

namespace LumenNotification;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Support\ServiceProvider;
use LumenNotification\Commands\LumenNotificationMakeCommand;
use LumenNotification\Commands\LumenNotificationPublishCommand;
use LumenNotification\Commands\NotificationTableCommand;

class LumenNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register the package services.
     */
    public function register(): void
    {
        $this->registerConfigs();
        $this->registerCommands();
        $this->registerBind();
        $this->registerPublish();
        $this->registerProviders();
    }

    /**
     * Publish the default configuration files.
     */
    protected function registerPublish(): void
    {
        $this->publishes([
            __DIR__ . '/Config/mail.php' => $this->config_path('mail.php'),
            __DIR__ . '/Config/services.php' => $this->config_path('services.php'),
        ]);
    }

    /**
     * Register the artisan commands.
     */
    protected function registerCommands(): void
    {
        $this->commands([
            LumenNotificationPublishCommand::class,
            LumenNotificationMakeCommand::class,
            NotificationTableCommand::class,
        ]);
    }

    /**
     * Load the application configuration, falling back to the package defaults.
     *
     * Lumen only loads a config file when it is asked to, so it is configured
     * explicitly; the defaults are then merged underneath whatever the
     * application defines.
     */
    protected function registerConfigs(): void
    {
        // Laravel's Application has an unrelated static configure(); only Lumen's is an instance loader.
        if (! $this->app instanceof FoundationApplication && method_exists($this->app, 'configure')) {
            $this->app->configure('mail');
            $this->app->configure('services');
        }

        $this->mergeConfigFrom(__DIR__ . '/Config/mail.php', 'mail');
        $this->mergeConfigFrom(__DIR__ . '/Config/services.php', 'services');
    }

    /**
     * Register the Laravel providers needed by notifications.
     */
    protected function registerProviders(): void
    {
        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(MailServiceProvider::class);
    }

    /**
     * Bind the mailer contract to the mailer instance.
     */
    protected function registerBind(): void
    {
        $this->app->bind(MailerContract::class, fn ($app) => $app['mailer']);
    }

    /**
     * Return the path of a file in the application config directory.
     */
    public function config_path(string $path): string
    {
        return $this->app->basePath('config/') . $path;
    }
}
