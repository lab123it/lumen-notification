<?php

namespace LumenNotification\Tests;

use LumenNotification\LumenNotificationServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [LumenNotificationServiceProvider::class];
    }
}
