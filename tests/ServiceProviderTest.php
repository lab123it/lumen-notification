<?php

namespace LumenNotification\Tests;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Support\Facades\Artisan;
use LumenNotification\LumenNotificationServiceProvider;

class ServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Providers are registered before defineEnvironment() runs, so
        // re-register with an application config that lacks most services.
        $this->app['config']->set('services', ['postmark' => ['token' => 'app-token']]);
        $this->app->register(LumenNotificationServiceProvider::class, true);
    }

    public function test_it_wires_mailer_and_notification_dispatcher(): void
    {
        $this->assertInstanceOf(Mailer::class, $this->app->make(Mailer::class));
        $this->assertInstanceOf(Dispatcher::class, $this->app->make(Dispatcher::class));
    }

    public function test_package_defaults_fill_keys_the_application_does_not_define(): void
    {
        $this->assertSame('us-east-1', config('services.sns.region'));
    }

    public function test_application_config_wins_over_package_defaults(): void
    {
        $this->assertSame('app-token', config('services.postmark.token'));
    }

    public function test_commands_are_registered(): void
    {
        $commands = array_keys(Artisan::all());

        $this->assertContains('lumen-notification:notification', $commands);
        $this->assertContains('lumen-notification:publish', $commands);
        $this->assertContains('lumen-notification:table', $commands);
    }
}
