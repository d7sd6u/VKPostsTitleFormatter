<?php
use PHPUnit\Framework\TestCase;

use d7sd6u\VKPostsTitleGenerator\Generator;

final class SyntheticTitleGeneratorTest extends TestCase
{
	protected function setUp(): void {
		date_default_timezone_set('UTC');
	}

	/**
	 * @dataProvider pregeneratedTitles
	 */
	public function testTitleGeneratingStillWorksOnPregeneratedData($post, $pregeneratedTitle): void {
		$generator = new Generator();
		$generator->setPost($post);
		$title = $generator->generateTitle();

		$this->assertEquals($title, $pregeneratedTitle);
	}

	public function pregeneratedTitles() {
		$pairs = array();

		$titlesPaths = glob('tests/data/titles/*');
		foreach($titlesPaths as $titlePath) {
			$title = file_get_contents($titlePath);

			$pathAsArray = explode('/', $titlePath);
			$postId = array_pop($pathAsArray);

			$postPath = __DIR__ . '/data/posts/' . $postId;
			$postInJson = file_get_contents($postPath);
			$post = json_decode($postInJson, true);

			$pairs[] = array($post, $title);
		}

		return $pairs;
	}
}