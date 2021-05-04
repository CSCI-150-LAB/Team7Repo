<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Curl\Curl;

require_once __DIR__ . '/../app/lib/vendor/autoload.php';
require_once __DIR__ . '/helpers/Config.php';

final class AuthenticationTest extends TestCase
{
	public function testFailedLogin(): void
	{
		$url = getConfig('siteUrl');

		$req = new Curl();
		$req->post("{$url}/User/Login", array(
			'email' => 'this',
			'password' => 'fails',
		));

		$this->assertStringContainsString('<li>Email or password invalid</li>', $req->response, 'Bad credentials fail');
	}

	public function testStudentLogin(): void
	{
		$url = getConfig('siteUrl');

		$req = new Curl();
		$req->post("{$url}/User/Login", array(
			'email' => 'student@csufresno.edu',
			'password' => 'student1',
		));

		$redirect = $req->getResponseHeaders('location');

		$this->assertEquals(302, $req->http_status_code, 'Proper redirect code');
		$this->assertEquals('http://localhost/FeedbackLoop/Student/Profile/1455', $redirect, 'Successful redirect after login');
	}
}