<?php

$loader = require 'vendor/autoload.php';

use Turing\MultiplicationTuringMachine;

$m = new MultiplicationTuringMachine();
$m->activateDebugMode();
$m->multiplicate("1011", "1010");
