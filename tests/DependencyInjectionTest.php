<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/helpers/DIClasses.php';

final class DependencyInjectionTest extends TestCase
{
	public function testTransientDependency(): void
	{
		$di = DI::getDefault();
		$di->addTransient(DITestClassTransient::class, DITestClassTransient::class);

		$instA = $di->get(DITestClassTransient::class);
		$instB = $di->get(DITestClassTransient::class);

		$this->assertEquals(false, $instA === $instB, 'Transient dependencies return unique values');
	}

	public function testScopedDependency(): void
	{
		$di = DI::getDefault();
		$di->addScoped(DITestClassScoped::class, DITestClassScoped::class);

		$instA = $di->get(DITestClassScoped::class);
		$instB = $di->get(DITestClassScoped::class);

		$this->assertEquals(true, $instA === $instB, 'Scoped dependencies return the exact same value');
	}

	public function testAutoInjection(): void
	{
		$di = DI::getDefault();
		$di->addTransient(DITestClassTransient::class, DITestClassTransient::class);
		$di->addScoped(DITestClassScoped::class, DITestClassScoped::class);
		$di->addTransient(DITestClassInjection::class, DITestClassInjection::class);

		$instA = $di->get(DITestClassTransient::class);
		$instB = $di->get(DITestClassScoped::class);
		/** @var DITestClassInjection */
		$instC = $di->get(DITestClassInjection::class);

		$this->assertEquals(false, $instA === $instC->testClassA, 'Injected transient property is unique');
		$this->assertEquals(true, $instB === $instC->testClassB, 'Injected transient property is unique');
	}
}