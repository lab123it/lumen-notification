# Lumen Notification

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)
[![tests](https://img.shields.io/github/actions/workflow/status/lab123it/lumen-notification/tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/lab123it/lumen-notification/actions/workflows/tests.yml)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)

Wires [Laravel Notifications](https://laravel.com/docs/notifications) and the mailer into applications that bootstrap the Illuminate components themselves: a service provider, default `mail` and `services` config, and the artisan commands that Laravel ships in its framework package.

## Requirements

- PHP ^8.2
- `illuminate/*` ^12.60 or ^13.10

Lumen stopped at Laravel 10, so it cannot install 1.x. Lumen apps must stay on `0.1.0-beta.2`.

## Installation

```bash
composer require lab123/lumen-notification
```

Register the provider (in a Lumen-style `bootstrap/app.php`):

```php
$app->register(\LumenNotification\LumenNotificationServiceProvider::class);
```

The provider registers `Illuminate\Notifications\NotificationServiceProvider` and `Illuminate\Mail\MailServiceProvider`, and merges the package `mail` and `services` defaults under whatever your application defines.

Publish the config files to `config/`:

```bash
php artisan lumen-notification:publish
```

## Commands

| Command | Equivalent in Laravel |
|---|---|
| `lumen-notification:notification Name` | `make:notification` |
| `lumen-notification:publish` | `vendor:publish` (`--force`, `--provider=`, `--tag=`) |
| `lumen-notification:table` | `notifications:table` |

See the [Laravel notification docs](https://laravel.com/docs/notifications) for how to write and send notifications.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG](CHANGELOG.md).

## Security

If you discover a security issue, please email jean.pierre@lab123.com.br instead of using the issue tracker.

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md).

## Credits

- [Jean Pierre](https://github.com/jeanpfs)

## License

The MIT License (MIT). See [License File](LICENSE.md).
