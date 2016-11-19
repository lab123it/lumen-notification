<?php
namespace LumenNotification;

use Illuminate\Support\ServiceProvider;

class LumenNotificationServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        // parent::boot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();
        
        $this->registerCommands();
        
        $this->registerBind();
        
        $this->registerPublish();
        
        $this->registerProviders();
    }

    /**
     * Publish configs.
     *
     * @return void
     */
    protected function registerPublish()
    {
        $this->publishes([
            __DIR__ . '/Config/mail.php' => config_path('mail.php'),
            __DIR__ . '/Config/services.php' => config_path('services.php')
        ]);
    }

    /**
     * Register for Lumen Application.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands(\LumenNotification\Commands\LumenNotificationPublishCommand::class);
        $this->commands(\LumenNotification\Commands\LumenNotificationMakeCommand::class);
    }

    /**
     * Register configs.
     *
     * @return void
     */
    protected function registerConfigs()
    {
        app()->configure('mail');
        app()->configure('services');
    }

    /**
     * Register configs.
     *
     * @return void
     */
    protected function registerProviders()
    {
        app()->register(\Illuminate\Notifications\NotificationServiceProvider::class);
        app()->register(\Illuminate\Mail\MailServiceProvider::class);
    }

    /**
     * Register component FileSystem.
     *
     * @return void
     */
    protected function registerBind()
    {
        app()->bind(\Illuminate\Contracts\Mail\Mailer::class, function ($app) {
            return $app['mailer'];
        });
    }
}