# Changelog

## 1.0.0

Breaking release: the package is rebuilt for current Lumen and Laravel.

- Requires PHP ^8.1 and `illuminate/*` ^10.0, ^11.0, ^12.60 or ^13.10. Lumen 10 and 11 and
  Laravel 10 to 13 are verified in real applications. Lumen 5 to 9 apps stay on `0.1.0-beta.2`.
- `illuminate/mail` 10 and 11 are affected by security advisory PKSA-zwc5-qtrz-zm1n and have
  no fix; Composer blocks them until the advisory is ignored. See the README.
- Fixed `lumen-notification:table`: the command had the wrong namespace and was never registered.
  It now creates an anonymous-class migration and does not need `Illuminate\Support\Composer`.
- Fixed mail notifications on Lumen: the provider binds `Illuminate\Contracts\Mail\Factory`
  and the concrete `Illuminate\View\Factory`, which Lumen does not alias.
- Fixed the service provider: the application config is loaded only on Lumen-style apps
  (Laravel's `Application::configure()` is an unrelated static method) and the package
  defaults are merged under whatever the application defines.
- Default `mail` config now uses the `default`/`mailers` layout; `services` config drops
  the removed SparkPost, SendGrid and Stripe entries and adds Postmark.
- Notification stub uses typed `via`, `toMail` and `toArray` signatures.
- Removed `guzzlehttp/guzzle` and the unused `Composer` dependency.
- Added tests and a GitHub Actions matrix (PHP 8.1 to 8.5, Laravel 10 to 13).

## 0.1 (2016-11-19)

- Initial Version
