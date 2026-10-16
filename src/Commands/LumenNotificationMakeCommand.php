<?php

namespace LumenNotification\Commands;

use Illuminate\Console\GeneratorCommand;

class LumenNotificationMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-notification:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new notification class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Notification';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return __DIR__.'/stubs/notification.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Notifications';
    }
}
