<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Elasticsearch hosts
	|--------------------------------------------------------------------------
	|
	| Define the elasticsearch servers the application can connect to.
	| To be defined as "hostname:port".
	*/

	'hosts' => [
		'localhost:9200',
	],

	/*
	|--------------------------------------------------------------------------
	| Elasticsearch indices
	|--------------------------------------------------------------------------
	|
	| Define which indices should be registered with Elasticsearcher. Use the
	| FQDN of the index.
	*/
	'indices' => [],

];
