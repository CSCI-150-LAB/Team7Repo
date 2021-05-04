<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/helpers/Config.php');

final class AnonymousTest extends TestCase
{
    public function testHomepage(): void
    {
		$url = getConfig('siteUrl');
		$html = file_get_contents("{$url}");
		$this->assertStringContainsString('<h2>Welcome to FeedbackLoop!</h2>', $html, 'Welcome message exists');
    }
}