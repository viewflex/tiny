# Tiny

[![GitHub license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](LICENSE.md)

Provides generation and serving of shortened URLs in a Laravel application.


## Overview

### Basic Steps

* Install this package in your Laravel application.
* Run the database migration to create the table for storing URLs.
* Add URLs manually via the web UI, or programatically via the `TinyService` class.

### Architecture

All interaction with the database is handled by a repository class implementing the `TinyQueryInterface` (by default, the `TinyQuery` class). The concrete query class is bound via the package configuration, so it's easy to create and deploy a new query class for an alternate data source (NoSQL, key-value store, etc), without hacking the package itself.


## Installation

From your Laravel application's root directory, install via Composer:

```bash
composer require viewflex/tiny
```

Add the `TinyServiceProvider` to the list of providers in `config/app.php`. *Note: This is not necessary when using Laravel 5.5 or greater with package discovery enabled.*

```php
Viewflex\Tiny\TinyServiceProvider::class,
```

## Migration

Laravel 5.4 or greater can run the migration directly from the package.

```bash
php artisan migrate
```

For older versions of Laravel, publish the migration first.

```bash
php artisan vendor:publish  --tag='tiny-data'
```

## Configuration

The `tiny.php` config file contains the package settings.

```php
'caching'       => [
	'active'        =>  true,
	'minutes'       =>  1440
],

'query'         => '\Viewflex\Tiny\Queries\TinyQuery',

'tables'        => [
	'urls'          => 'tiny_urls'
]
```

If you need to customize the configuration, run this command to publish the config file to the project's `config` directory:

```bash
php artisan vendor:publish  --tag='tiny'
```

This will also publish the UI view template to your project's `resources/views/vendor/tiny` directory. Unless you need to customize one of these files it is not necessary to publish them.

### Caching

By default, URL lookups are cached, which greatly increases performance. You can disable this or change the cache lifetime to suit your needs.

### Query

This is the repository class that interacts with the data source. Any class implementing the `TinyQueryInterface` can be used in place of the default, as needed.

### Tables

Here the table name is aliased, to allow using whatever table name you want without hacking the package.

## Usage

### Adding URLs

The `TinyController` provides a UI for adding URLs. Simply enter a URL and click the Save button. The URL will be displayed along with it's alias in the resulting message. The route `<mydomain>/tiny/create` is used to access the UI from a web browser. It is also quite easy to integrate the `TinyService` class into your own code, to generate and store URLs programatically.

### Serving URLs

Once stored, a URL can be accessed via the `<mydomain>/tiny/{hash}` package route. Of course, if necessary you can also create an additional route to hit the same controller method.

## Tests

Tests can be run in the usual way, as described in the [test documentation](./tests/README.md).

## License

This software is offered for use under the [MIT License](LICENSE.md).

