<?php

require 'src/TuringMachine.php';
require 'src/State.php';
require 'src/Transition.php';
require 'src/Tape.php';


$q_0 = new State("Q0");
$q_1 = new State("Q1", true);

$q_0->addTransition(new Transition(["0","0"],["0","0"],["R","R"], $q_0));
$q_0->addTransition(new Transition(["0","1"],["0","1"],["R","R"], $q_0));
$q_0->addTransition(new Transition(["1","0"],["0","1"],["R","R"], $q_0));
$q_0->addTransition(new Transition(["1","1"],["0","0"],["R","R"], $q_0));
$q_0->addTransition(new Transition(["-","-"],["-","-"],["N","N"], $q_1));

$states = [
    $q_0, $q_1
];

$initialState = $q_0;

/*
$tapes = [
    new Tape("1001"), // Input Tape 1
    new Tape("1011"), // Input Tape 2
    new Tape("") // Output Tape
];
*/

$tapes = [
    new Tape("1001"),
    new Tape("1111")
];

$tm = new TuringMachine($tapes, $states, $initialState, 1);
$tm->run();