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
			$num1 = rand(0,sqrt(PHP_INT_MAX));
			$num2 = rand(0,sqrt(PHP_INT_MAX));
			$expectedResult = $num1 * $num2; 

			$m->multiplicate($num1, $num2, false);
			
			$tapes = $m->getTapes();
			$input0 = str_replace(MultiplicationTuringMachine::EMPTY_SYMBOL, "", $tapes[0]->getContent());
			$input1 = str_replace(MultiplicationTuringMachine::EMPTY_SYMBOL, "", $tapes[1]->getContent());
			$this->assertEquals(decbin($num1), $input0);			
			$this->assertEquals(decbin($num2), $input1);			


			$m->run();
			$result = $m->getResult();


			$this->assertEquals($expectedResult, $result);

			$tapes = $m->getTapes();
			$resultTape = str_replace(MultiplicationTuringMachine::EMPTY_SYMBOL, "", $tapes[2]->getContent());
			$this->assertEquals(decbin($expectedResult), $resultTape);
		}
	}

	public function testHugeNumbers()
	{
		$this->setOutputCallback(function() {});
		for ($i=0; $i < 50; $i++) { 
			$m = new MultiplicationTuringMachine();
			$num1 = rand(sqrt(PHP_INT_MAX), PHP_INT_MAX);
			$num2 = rand(sqrt(PHP_INT_MAX), PHP_INT_MAX);
			$expectedResult = $num1 * $num2; 

			$m->multiplicate($num1, $num2, false);
			
			$tapes = $m->getTapes();
			$input0 = str_replace(MultiplicationTuringMachine::EMPTY_SYMBOL, "", $tapes[0]->getContent());
			$input1 = str_replace(MultiplicationTuringMachine::EMPTY_SYMBOL, "", $tapes[1]->getContent());
			$this->assertEquals(decbin($num1), $input0);			
			$this->assertEquals(decbin($num2), $input1);			


			$m->run();
			$result = $m->getResult();
			$this->assertEquals($expectedResult, $result, '', $expectedResult/pow(10,15));
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