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
- Bootstrap 4 or Bootstrap 5 when using the package views without customization

The package provides ready-to-use views for Bootstrap 4 and Bootstrap 5.

Bootstrap is only required when using these views without customization. Applications that do not use Bootstrap can publish the package views and adapt their markup and styles to their own front-end framework.

## Installation

Install the package with Composer:

```bash
composer require fbollon/lara-cms-lite
```

Run the migrations:

```bash
php artisan migrate
```

A `contents` table will be created. If your application already contains a table with this name, publish the package configuration and change the `table` value in `config/lara-cms-lite.php`.

## Configuration

Publish the package configuration:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=config
```

The configuration file will be published to:

```text
config/lara-cms-lite.php
```

Review the available options and adjust them to match your application.

## Bootstrap version

The package provides ready-to-use views for Bootstrap 4 and Bootstrap 5.

Bootstrap is only required when using the provided views without customization. Applications that do not use Bootstrap can publish the package views and adapt their markup and styles to their own front-end framework.

Set the Bootstrap version used by the package in your application's `.env` file:

```env
LARA_CMS_LITE_BOOTSTRAP_VERSION=5
```

Supported values are:

- `4` for Bootstrap 4 views
- `5` for Bootstrap 5 views

After changing the Bootstrap version, clear Laravel's configuration cache:

```bash
php artisan config:clear
```

To publish the package views:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views
```

The published views can then be customized from:

```text
resources/views/vendor/lara-cms-lite
```

To overwrite previously published views, use the `--force` option:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views --force
```

> **Warning:** The `--force` option overwrites existing published views. Back up or compare your customized views before running this command.

### Bootstrap dependency

Lara CMS Lite does not install or load Bootstrap. The host application must already include the Bootstrap CSS and JavaScript corresponding to the version selected in the package configuration.

If the host application does not use Bootstrap, publish the package views and adapt their markup and CSS classes to the front-end framework or custom styles used by the application.

### TinyMCE

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

## Publishing views

Publishing the views is optional. The application uses the views included in the package by default.

Publish the views only when you need to customize them or when the host application does not use Bootstrap:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views
```

The views will be published to:

```text
resources/views/vendor/lara-cms-lite
```

Published views override the views included in the package. Once published, future package view updates are not applied automatically to the application.

To overwrite previously published views, use the `--force` option:

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider" --tag=views --force
```

Warning: `--force` overwrites any custom changes made to the published views. Back up or compare customized files before running this command.

## Authorization

Add a `canManageLaraCmsLiteContent()` method to your application's user model and implement the authorization logic required by your application:

```php
public function canManageLaraCmsLiteContent(): bool
{
    return true;
}
```

For example, you can check a role or another property:

```php
public function canManageLaraCmsLiteContent(): bool
{
    return $this->role === 'admin';
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

Update the package and its related dependencies with:

```bash
composer update fbollon/lara-cms-lite -W
```

Then clear the application caches and run pending migrations:

```bash
php artisan optimize:clear
php artisan migrate
```

If the views were published and the package provides updated views, compare the package views with the customized application views before republishing them.

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for information about recent changes.

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability, please report it privately to the package maintainer instead of opening a public issue.

## Credits

- [Frédéric Bollon](https://github.com/fbollon)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [LICENSE.md](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
