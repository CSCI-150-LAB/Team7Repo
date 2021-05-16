<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Curl\Curl;

final class AnonymousTest extends TestCase
{
	public function testHomepage(): void
	{
		$url = getConfig('siteUrl');

		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get($url);

		$this->assertStringContainsString('<h2>Welcome to FeedbackLoop!</h2>', $req->response, 'Welcome message exists');
	}
}