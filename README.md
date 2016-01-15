# elasticsearcher-laravel

## Installation

1. Installation of the latest version is easy via [composer](https://getcomposer.org/):

```
composer require madewithlove/elasticsearcher-laravel
```

2. Update config/app.php to register the provider

```php
# Add `BugsnagLaravelServiceProvider` to the `providers` array
'providers' => array(
    ...
    Madewithlove\ElasticSearcherLaravel\ServiceProvider::class,
)
```
