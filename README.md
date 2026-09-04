# Lara CMS Lite

A lightweight content management package for Laravel applications.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fbollon/lara-cms-lite.svg?style=flat-square)](https://packagist.org/packages/fbollon/lara-cms-lite)
[![Total Downloads](https://img.shields.io/packagist/dt/fbollon/lara-cms-lite.svg?style=flat-square)](https://packagist.org/packages/fbollon/lara-cms-lite)
[![License](https://img.shields.io/packagist/l/fbollon/lara-cms-lite.svg?style=flat-square)](LICENSE.md)

Lara CMS Lite allows authorized users to add and manage content on predefined pages of a Laravel application. It is especially useful for intranet and business applications where selected text must be updated without modifying the application's source code.

The package can also be used to add simple news or blog-style content to an existing application.

## Requirements

- PHP 8.2 or later
- Laravel 11 or 12

## Installation

Install the package with Composer:

```bash
composer require fbollon/lara-cms-lite
```

Publish the package configuration and views:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider"
```

You can also publish resources individually by tag:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=config
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views
```

To overwrite previously published files, add the `--force` option:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=config --force
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views --force
```

Run the migrations:

```bash
php artisan migrate
```

A `contents` table will be created. If your application already contains a table with this name, change the `table` value in:

```text
config/lara-cms-lite.php
```

## TinyMCE

TinyMCE is loaded from the jsDelivr CDN by default. It is no longer installed or published through Composer.

Default URL:

```text
https://cdn.jsdelivr.net/npm/tinymce@8.9.0/tinymce.min.js
```

You can override this URL in the application's `.env` file, for example to use another CDN or a locally hosted copy:

```env
LARA_CMS_LITE_TINYMCE_URL=https://example.com/tinymce/tinymce.min.js
```

After changing the URL, clear Laravel's configuration cache:

```bash
php artisan config:clear
```

If the package configuration was previously published, make sure `config/lara-cms-lite.php` contains the current `tinymce_url` setting.

## Authorization

Add a `canManageLaraCmsLiteContent()` method to your application's user model and implement the authorization logic required by your application:

```php
public function canManageLaraCmsLiteContent(): bool
{
    return true;
}
```

Define the `lara-cms-lite-manage` gate in your application's authorization configuration:

```php
use Illuminate\Support\Facades\Gate;

Gate::define('lara-cms-lite-manage', function ($user) {
    return $user->canManageLaraCmsLiteContent();
});
```

Replace the sample logic with the appropriate roles or permissions for your application.

## Usage

Visit the following URL to create and manage content:

```text
https://your-application.test/contents
```

### Display content in an existing view

Add the following code where the contextual content should be displayed:

```blade
@if (!empty($contents) && count($contents))
    @include('lara-cms-lite::layouts.partials.contents')
@endif
```

In each controller method that displays managed content, import the `Content` model, retrieve the contextual content, and pass it to the view:

```php
use Fbollon\LaraCmsLite\Models\Content;

public function index()
{
    $contents = Content::getContextualContent();

    return view('your.view', compact('contents'));
}
```

## Updating

Update the package and any related dependencies with:

```bash
composer update fbollon/lara-cms-lite -W
```

Then clear the application caches and run pending migrations:

```bash
php artisan optimize:clear
php artisan migrate
```

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for information about recent changes.

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability, please report it privately to the package maintainer instead of opening a public issue.

## Credits

- [Frederic Bollon](https://github.com/fbollon)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [LICENSE.md](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
