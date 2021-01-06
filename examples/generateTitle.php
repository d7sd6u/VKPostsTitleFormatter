<?php

require "examplePost.php";
require dirname(__DIR__) . "/vendor/autoload.php";

use d7sd6u\VKPostsTitleGenerator\Generator;

$options = array(

);

$titleGenerator = new Generator($options);

$titleGenerator->setPost($post);

echo $titleGenerator->generateTitle();