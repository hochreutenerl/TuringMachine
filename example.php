<?php

$loader = require 'vendor/autoload.php';

use Turing\Tape;
use Turing\State;
use Turing\Transition;
use Turing\TuringMachine;

$q_0 = new State("Q0");
$q_1 = new State("Q1", true);

$q_0->addTransition(new Transition(["1"],["0"],["R"], $q_0));
$q_0->addTransition(new Transition(["0"],["1"],["R"], $q_0));
$q_0->addTransition(new Transition([" "],[" "],["N"], $q_1));

$initialState = $q_0;

$tapes = [
  new Tape("101")
];

$tm = new TuringMachine($tapes, $initialState, 1);
$tm->run();