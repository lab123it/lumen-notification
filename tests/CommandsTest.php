<?php

namespace LumenNotification\Tests;

use Illuminate\Support\Facades\File;

class CommandsTest extends TestCase
{
    /** @var array<string, string> */
    private array $originalConfigs = [];

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['mail.php', 'services.php'] as $name) {
            $this->originalConfigs[config_path($name)] = file_get_contents(config_path($name));
        }
    }

    protected function tearDown(): void
    {
        File::delete(app_path('Notifications/InvoicePaid.php'));
        File::delete(File::glob(database_path('migrations/*_create_notifications_table.php')));

        foreach ($this->originalConfigs as $path => $contents) {
            file_put_contents($path, $contents);
        }

        parent::tearDown();
    }

    public function test_make_command_generates_a_notification_class(): void
    {
        $this->artisan('lumen-notification:notification', ['name' => 'InvoicePaid'])->assertExitCode(0);

        $file = app_path('Notifications/InvoicePaid.php');
        $this->assertFileExists($file);

        $contents = file_get_contents($file);
        $this->assertStringContainsString('class InvoicePaid extends Notification', $contents);
        $this->assertStringContainsString('namespace App\Notifications;', $contents);
    }

    public function test_table_command_creates_the_notifications_migration(): void
    {
        $this->artisan('lumen-notification:table')->assertExitCode(0);

        $files = File::glob(database_path('migrations/*_create_notifications_table.php'));
        $this->assertCount(1, $files);
        $this->assertStringContainsString("Schema::create('notifications'", file_get_contents($files[0]));
    }

    public function test_publish_command_copies_config_and_respects_existing_files(): void
    {
        $this->artisan('lumen-notification:publish')->assertExitCode(0);

        $this->assertFileExists(config_path('mail.php'));
        $this->assertFileExists(config_path('services.php'));

        file_put_contents(config_path('mail.php'), '<?php return ["kept" => true];');

        $this->artisan('lumen-notification:publish')->assertExitCode(0);
        $this->assertStringContainsString('kept', file_get_contents(config_path('mail.php')));

        $this->artisan('lumen-notification:publish', ['--force' => true])->assertExitCode(0);
        $this->assertStringContainsString('Default Mailer', file_get_contents(config_path('mail.php')));
    }
}
