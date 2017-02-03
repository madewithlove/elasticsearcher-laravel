<?php

namespace Madewithlove\ElasticSearcherLaravel\Console;

use ElasticSearcher\Managers\IndicesManager;
use Illuminate\Console\Command;

/**
 * Create an index in elasticsearch.
 */
class CreateIndexCommand extends Command
{
	/**
	 * @var string
	 */
	protected $signature = 'search:create-index
							{index : The name of the index to create}
							{--f : Force, will drop the index if it exists}';

	/**
	 * @var string
	 */
	protected $description = 'Create (or recreate) an index in elasticsearch';

	/**
	 * @var IndicesManager
	 */
	protected $indicesManager;

	/**
	 * @param IndicesManager $indicesManager
	 */
	public function __construct(IndicesManager $indicesManager)
	{
		parent::__construct();
		$this->indicesManager = $indicesManager;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$indexName = $this->argument('index');

		if (!$this->indicesManager->isRegistered($indexName)) {
			$this->error('The index "'.$indexName.'" is not registered in Elasticsearcher"');

			return 1;
		}

		if ($this->indicesManager->exists($indexName)) {
			if ($this->option('f')) {
				$this->indicesManager->delete($indexName);
				$this->info('The index "'.$indexName.'" existed and was dropped.');
			} else {
				$this->error('The index "'.$indexName.'" already exists. Use --f if you want to drop and create.');

				return 1;
			}
		}

		$this->indicesManager->create($indexName);
		$this->info('The index "'.$indexName.'" was created.');

		return 0;
	}
}
