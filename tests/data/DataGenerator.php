<?php

define('ROOTDIR', dirname(dirname(__DIR__)));

require_once ROOTDIR . '/vendor/autoload.php';

use d7sd6u\VKPostsTitleGenerator\Generator;

date_default_timezone_set('UTC');

$generator = new Generator();

$postPaths = glob('tests/data/posts/*');
foreach($postPaths as $postPath) {
	$postInJson = file_get_contents($postPath);
	$post = json_decode($postInJson, true);

	$generator->setPost($post);

	try {
		$title = $generator->generateTitle();
	} catch(\Exception $e) {
		die('Title generating gone horribly wrong: ' . $e->getMessage() . "\n");
	}

	file_put_contents(__DIR__ . "/titles/$post[id]", $title);

	echo "Generated title for $post[id] post\n";
}

echo "Generated titles for all posts\n";

