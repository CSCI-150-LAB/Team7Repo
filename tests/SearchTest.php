<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Curl\Curl;

require_once __DIR__ . '/../app/lib/vendor/autoload.php';
require_once __DIR__ . '/helpers/Config.php';

final class SearchTest extends TestCase {

	public function testSearchByNamePresent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/rob");
		$this->assertStringContainsString('Robert Wong', $req->response, 'Instructor Robert Wong was found in search results');
	}

	public function testSearchByNameAbsent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/rob");

		$this->assertStringNotContainsString('Sumanjit Gill', $req->response, 'Instructor Sumanjit Gill was not found in search results');
	}

	public function testSearchByClassPresent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/csci%20152");
		$this->assertStringContainsString('Alex Liu', $req->response, 'Instructor Alex Liu was found in search results');
	}

	public function testSearchByClassAbsent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/csci%20152");
		$this->assertStringNotContainsString('Robert Wong', $req->response, 'Instructor Robert Wong was not found in search results');
	}

    public function testSearchByEmailPresent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/karlamoreno334");
		$this->assertStringContainsString('Karla Moreno', $req->response, 'Instructor Karla Moreno was found in search results');
	}

	public function testSearchByEmailAbsent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/karlamoreno334");
		$this->assertStringNotContainsString('Daniel Flynn', $req->response, 'Instructor Daniel Flynn was not found in search results');
	}

    public function testSearchByDepartmentPresent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/computer%20eng");
		$this->assertStringContainsString('Sumanjit Gill', $req->response, 'Instructor Sumanjit Gill was found in search results');
	}

    public function testSearchByDepartmentAbsent(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/computer%20eng");
		$this->assertStringNotContainsString('Karla Moreno', $req->response, 'Instructor Karla Moreno was not found in search results');
	}
    public function testSearchNoResults(): void
	{
		$url = getConfig('siteUrl');
		$req = new Curl();
		// $req->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$req->get("{$url}/Instructor/Search/chem");
		$this->assertStringContainsString('No results found.', $req->response, 'No results were produced with this search');
	}
}