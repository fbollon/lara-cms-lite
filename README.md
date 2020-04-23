# Lightweight content manager package for Laravel applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fbollon/lara-cms-lite.svg?style=flat-square)](https://packagist.org/packages/fbollon/lara-cms-lite)
[![Build Status](https://img.shields.io/travis/fbollon/lara-cms-lite/master.svg?style=flat-square)](https://travis-ci.org/fbollon/lara-cms-lite)
[![Quality Score](https://img.shields.io/scrutinizer/g/fbollon/lara-cms-lite.svg?style=flat-square)](https://scrutinizer-ci.com/g/fbollon/lara-cms-lite)
[![Total Downloads](https://img.shields.io/packagist/dt/fbollon/lara-cms-lite.svg?style=flat-square)](https://packagist.org/packages/fbollon/lara-cms-lite)


Lara-cms-lite allows you to give users the possibility to add content to some predefined pages in your Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require fbollon/lara-cms-lite
```

Publish config file and adjust values if needed in config/lara-cms-lite.php based on comments

```bash
php artisan vendor:publish --provider="Fbollon\LaraCmsLite\LaraCmsLiteServiceProvider"
```

Create required tables

```bash
php artisan migrate
```
A table named 'contents' will be created, if a table with the same name already exists in your app change value of 'table' in config/lara-cms-lite.php



## Usage

Visit your application url : http://yourApplication/contents to start creating and managing content .

To display content in existing views of your application 

In you default layout add this where you want to display content in your layout

``` php
@if (!empty($contents) && count($contents))
@include('lara-cms-lite::partials.contents')
@endif

```
Depending where you allow users to add content in yours methods controller add 

``` php
// import model 
use Fbollon\LaraCmsLite\Models\Content;
```

``` php
// for each method you allow to display content
public function xxx()
{
    // get content 
    $contents = Content::getContextualContent();

    // and send content to the view
    return view('xxx.xxx', compact('contents'));
}
```        

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security


## Credits

- [Frédéric Bollon](https://github.com/fbollon)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).