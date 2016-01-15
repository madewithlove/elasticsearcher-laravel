<?php

namespace Madewithlove\ElasticSearcherLaravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use ElasticSearcher\ElasticSearcher;
use ElasticSearcher\Environment;
use ElasticSearcher\Managers\DocumentsManager;
use ElasticSearcher\Managers\IndicesManager;

class ServiceProvider extends BaseServiceProvider
{
	/**
	 * Register the service provider.
	 */
	public function register()
	{
		$this->app->singleton(ElasticSearcher::class, function ($app) {
			$environment = new Environment(
				['hosts' => $app['config']->get('elasticsearcher.hosts')]
			);
			return new ElasticSearcher($environment);
		});
		$this->app->singleton(DocumentsManager::class, function ($app) {
			return $app->make(ElasticSearcher::class)->documentsManager();
		});
		$this->app->singleton(IndicesManager::class, function ($app) {
			return $app->make(ElasticSearcher::class)->indicesManager();
		});
	}

	/**
	 * Boot the service provider
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/elasticsearcher.php' => config_path('elasticsearcher.php'),
		]);
	}
}
