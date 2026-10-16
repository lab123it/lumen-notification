<?php

namespace LumenNotification\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;

class NotificationTableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-notification:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the notifications table';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $creator = new MigrationCreator($this->files, '');
        $path = $creator->create('create_notifications_table', $this->laravel->databasePath('migrations'));

        $this->files->put($path, $this->files->get(__DIR__.'/stubs/notifications.stub'));

        $this->info('Migration created successfully!');
    }
}
