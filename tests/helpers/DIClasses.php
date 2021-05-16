<?php

class DITestClassTransient {}

class DITestClassScoped {}

class DITestClassInjection {
	public $testClassA;
	public $testClassB;

	public function __construct(DITestClassTransient $a, DITestClassScoped $b) {
		$this->testClassA = $a;
		$this->testClassB = $b;
	}
}