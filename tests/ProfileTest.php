<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/helpers/Config.php');

final class ProfileTest extends TestCase
{
    public function testinstructorFeedbackNone(): void
    {
		$url = getConfig('siteUrl');
		$html = file_get_contents("{$url}Instructor/Profile/1454");
		$this->assertStringContainsString('No recommendations yet', $html, 'Alternative when there are no recommendations appears');
    }

    public function testinstructorFeedbackExists(): void
    {
		$url = getConfig('siteUrl');
		$html = file_get_contents("{$url}Instructor/Profile/1443");
		$this->assertStringContainsString('<div class="author">', $html, 'Recommendation appears on page');
    }

    public function testinstructorFeedbackVerified(): void
    {
		$url = getConfig('siteUrl');
		$html = file_get_contents("{$url}Instructor/Profile/1443");
		$this->assertStringContainsString('<i class="fas fa-check ml-1 text-success"></i>', $html, 'Verified checkmark appears');
    }
}