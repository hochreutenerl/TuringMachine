<?php

require 'src/TuringMachine.php';
require 'src/State.php';
require 'src/Transition.php';
require 'src/Tape.php';


$q_0 = new State([]);
$q_1 = new State([], true);

$q_0->addTransition(new Transition("1","0","R", $q_0));
$q_0->addTransition(new Transition("0","1","R", $q_0));
$q_0->addTransition(new Transition("","","N", $q_1));

$states = [
    $q_0, $q_1
];

$initialState = $q_0;

$tapes = [
  new Tape("101")
];

$tm = new TuringMachine($tapes, $states, $initialState, 1);
$tm->run();