<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SomeTest extends TestCase
{
    public function testOnePlusOneEquals2(): void
    {
		$this->assertEquals(2, 1 + 1, '1 + 1');
    }
}