# Lumen Notification

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)
[![tests](https://img.shields.io/github/actions/workflow/status/lab123it/lumen-notification/tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/lab123it/lumen-notification/actions/workflows/tests.yml)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/lab123/lumen-notification.svg?style=flat-square)](https://packagist.org/packages/lab123/lumen-notification)

[Laravel Notifications](https://laravel.com/docs/notifications) for Lumen: a service provider that wires notifications and the mailer, default `mail` and `services` config, and the artisan commands Lumen lacks (`make:notification`, `vendor:publish`, `notifications:table`).

It also works on Laravel itself.

## Requirements

- PHP ^8.1
- Lumen 10 or 11, or Laravel 10, 11, 12 or 13 (`illuminate/*` ^10.0, ^11.0, ^12.60 or ^13.10)

Verified in real applications: Lumen 10.0 and 11.1, Laravel 10.50, 11.57, 12.70 and 13.37.

Lumen 5 to 9 apps cannot use this release; stay on `0.1.0-beta.2`.

## Installation

```bash
composer require lab123/lumen-notification
```

### Laravel 10 and 11, Lumen 10 and 11: security advisory

Composer blocks `illuminate/mail` 10 and 11 because of advisory [PKSA-zwc5-qtrz-zm1n](https://packagist.org/security-advisories/PKSA-zwc5-qtrz-zm1n) (CRLF injection in the default email validation rule). Laravel 10 and 11 are end of life and **have no fix**; only `illuminate/*` ^12.60 and ^13.10 are patched. Running Lumen on Laravel components 10 or 11 means you accept that. To install anyway, in your project:

```bash
composer config policy.advisories.ignore-id --json '["PKSA-zwc5-qtrz-zm1n"]'
composer require lab123/lumen-notification
```

Laravel 10 itself carries other unfixed advisories, so Composer may ask you to ignore those too. Upgrade the framework when you can.

### Register the provider

Lumen (`bootstrap/app.php`):

```php
$app->register(\LumenNotification\LumenNotificationServiceProvider::class);
```

Laravel 11+ (`bootstrap/providers.php`) or Laravel 10 (`config/app.php`): add `\LumenNotification\LumenNotificationServiceProvider::class`.

The provider registers `Illuminate\Notifications\NotificationServiceProvider` and `Illuminate\Mail\MailServiceProvider`, binds the mail contracts that Lumen does not alias, and merges the package `mail` and `services` defaults under whatever your application defines.

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

For the database channel on Lumen, `lumen-notification:table` creates the migration; run it with your own migration tooling, since Lumen has no `migrate` command.

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
