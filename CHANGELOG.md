# Changelog

## 1.0.0

Breaking release. The package is rebuilt for current Laravel components.

- Requires PHP ^8.2 and `illuminate/*` ^12.60 or ^13.10 (older lines are affected by
  security advisory PKSA-zwc5-qtrz-zm1n and are not supported). Lumen itself stops at
  Laravel 10, so it can no longer install this version; stay on 0.1.0-beta.2.
- Fixed `lumen-notification:table`: the command had the wrong namespace and was never registered.
  It now creates an anonymous-class migration and does not need `Illuminate\Support\Composer`.
- Fixed the service provider: the application config is loaded only on Lumen-style apps and
  the package defaults are merged under whatever the application defines.
- Default `mail` config now uses the `default`/`mailers` layout; `services` config drops
  the removed SparkPost, SendGrid and Stripe entries and adds Postmark.
- Notification stub uses typed `via`, `toMail` and `toArray` signatures.
- Removed `guzzlehttp/guzzle` and the unused `Composer` dependency.
- Added tests and a GitHub Actions matrix (PHP 8.2 to 8.5).

## 0.1 (2016-11-19)

- Initial Version
