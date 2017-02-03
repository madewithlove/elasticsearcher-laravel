# elasticsearcher-laravel

This package allows easier implementation of the [madewithlove/elasticsearcher](https://github.com/madewithlove/elasticsearcher) package.
More information on their [docs](https://github.com/madewithlove/elasticsearcher#elasticsearcher).

## Installation

1. Installation of the latest version is easy via [composer](https://getcomposer.org/):

	```
	composer require madewithlove/elasticsearcher-laravel
	```

2. Update config/app.php to register the provider

	```php
	# Add `Madewithlove\ElasticSearcherLaravel\ServiceProvider` to the `providers` array
	'providers' => array(
			...
			Madewithlove\ElasticSearcherLaravel\ServiceProvider::class,
	)
	```

3. Publish the configuration file `config/elasticsearcher.php`

	```
	php artisan vendor:publish --provider="Madewithlove\ElasticSearcherLaravel\ServiceProvider"
	```

## Usage

### Configuration

You can use `config/elasticsearcher.php` for configuring elasticsearcher.

### Console

```
php artisan search:create-index <index-name>
```
