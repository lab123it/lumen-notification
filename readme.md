# Laravel 5.3 Notification for Lumen 5.x #

This package is a wrapper of [Laravel Notification](url "https://laravel.com/docs/5.3/notifications") adapted to work with Lumen 5.x

## Installation ##

Can to install with commands:

	composer require lab123ti/lumen-notification
	
Or editing the composer.json file:

	"require": {
    	"lab123/lumen-notification": "dev-master"
    }

## Register Service Provider ##

Register the package in the section "Register Service Providers"

	$app->register(\LumenNotification\LumenNotificationServiceProvider::class);
	

# Publish #

To can use the views from Laravel Notifications, use the command wrapper from php artisan vendor:publish:

	php artisan lumen-notification:publish
	

# Commands #

After register the Service Provider the aplication can execute the commands:

Equivalent to php artisan make:notification in Laravel 5.3
 
	php artisan lumen-notification:notification
	
Equivalent to php artisan vendor:publish in Laravel
 
	php artisan lumen-notification:publish