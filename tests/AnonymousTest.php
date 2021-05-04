<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class AnonymousTest extends TestCase
{
    public function testHomepage(): void
    {
		$html = file_get_contents('http://localhost/FeedbackLoop');
		$this->assertStringContainsString('<h2>Welcome to FeedbackLoop!</h2>', $html, 'Welcome message exists');
    }
}