# Laravel 5.3 Notification for Lumen 5.x #

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/lab123/lumen-notification/master.svg?style=flat-square)](https://travis-ci.org/lab123/lumen-notification)
[![Quality Score](https://img.shields.io/scrutinizer/g/lab123/lumen-notification.svg?style=flat-square)](https://scrutinizer-ci.com/g/lab123/lumen-notification)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/lab123/lumen-notification/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/lab123/lumen-notification/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)

This package is a wrapper of [Laravel Notification](https://laravel.com/docs/5.3/notifications) adapted to work with Lumen 5.x

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation ##

Can to install with commands:

	composer require lab123ti/lumen-notification
	
Or editing the `composer.json` file:

	"require": {
    	"lab123/lumen-notification": "dev-master"
    }

Register the package in the section "Register Service Providers" in `bootstrap/app.php`

	$app->register(\LumenNotification\LumenNotificationServiceProvider::class);
	

To can use the views from Laravel Notifications, use the command wrapper from php artisan vendor:publish:

	php artisan lumen-notification:publish
	

## Usage

After register the Service Provider the aplication can execute the commands:

Equivalent to php artisan make:notification in Laravel 5.3
 
	php artisan lumen-notification:notification
	
Equivalent to php artisan vendor:publish in Laravel
 
	php artisan lumen-notification:publish
	
### To more information how to use Notifications: [Laravel Notification](https://laravel.com/docs/5.3/notifications) ###

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email jean.pierre@lab123.com.br instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Jean Pierre](https://github.com/jeanpfs)
- [Felipe Santos](https://github.com/felipeds2)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.