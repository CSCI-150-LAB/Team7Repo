<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Curl\Curl;

final class ProfileTest extends TestCase
{
    public function testinstructorFeedbackNone(): void
	  {
	  	$url = getConfig('siteUrl');

	  	$req = new Curl();
	  	// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
	  	$req->get("{$url}Instructor/Profile/1454");

	  	$this->assertStringContainsString('No recommendations yet', $req->response, 'Alternative when there are no recommendations appears');
	  }

    public function testinstructorFeedbackExists(): void
	  {
	  	$url = getConfig('siteUrl');

	  	$req = new Curl();
	  	// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
	  	$req->get("{$url}Instructor/Profile/1443");

	  	$this->assertStringContainsString('<div class="author">', $req->response, 'Recommendation appears on page');
	  }

    public function testinstructorFeedbackVerified(): void
	  {
	  	$url = getConfig('siteUrl');

	  	$req = new Curl();
	  	// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
	  	$req->get("{$url}Instructor/Profile/1443");

	  	$this->assertStringContainsString('<i class="fas fa-check ml-1 text-success"></i>', $req->response, 'Verified checkmark appears');
	  }
}