<?php

namespace Turing;

$loader = require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Turing\MultiplicationTuringMachine;

class MultiplicationTest extends TestCase {
	public function testMultiplication()
	{
		$this->setOutputCallback(function() {});
		for ($i=0; $i < 50; $i++) { 
			$m = new MultiplicationTuringMachine();
			$num1 = rand(0,128);
			$num2 = rand(0,128);

			$result = $m->multiplicate($num1, $num2);
			$this->assertEquals(($num1 * $num2), $result);
		}
	}

	public function testMultiplicationByZero()
	{
		$this->setOutputCallback(function() {});
		$m = new MultiplicationTuringMachine();
		$result = $m->multiplicate(0, 54);
		$this->assertEquals(0, $result);

		$m = new MultiplicationTuringMachine();
		$result = $m->multiplicate(82, 0);
		$this->assertEquals(0, $result);
	}

}