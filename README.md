# Tenstreet API

## Installation

```php
composer require collingmedia/tenstreet-api
```

The service provider will automatically get registered. Or you may manually add the service provider in your `config/app.php` file:

```php
'providers' => [
    // ...
    CollingMedia\Tenstreet\ServiceProvider::class,
]
```

Publish the config file with:

```php
php artisan:publish --proivder="CollingMedia\Tenstreet\ServiceProvider" --tag="config"
```