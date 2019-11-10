<?php

namespace Madewithlove\ElasticSearcherLaravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use ElasticSearcher\ElasticSearcher;
use ElasticSearcher\Environment;
use ElasticSearcher\Managers\DocumentsManager;
use ElasticSearcher\Managers\IndicesManager;
use Madewithlove\ElasticSearcherLaravel\Console\CreateIndexCommand;

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
			$elasticSearcher = new ElasticSearcher($environment);

			$this->extendDocumentsManager($elasticSearcher->documentsManager());
			$this->extendIndicesManager($elasticSearcher->indicesManager());

			return $elasticSearcher;
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

		$this->commands([
			CreateIndexCommand::class,
		]);
	}

	/**
	 * Configures the provided Document manager.
	 * @param DocumentsManager $manager DocumentsManager to be configured.
	 */
	protected function extendDocumentsManager(DocumentsManager $manager): void
	{
	}

	/**
	 * Configures the provided Indices manager.
	 * @param IndicesManager $manager IndicesManager to be configured.
	 */
	protected function extendIndicesManager(IndicesManager $manager): void
	{
		$indices = array_map(function($index) {
			return $this->app->make($index);
		}, $this->app['config']->get('elasticsearcher.indices', []));

		$manager->registerIndices($indices);
	}
}
