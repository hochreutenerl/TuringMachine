<?php

$loader = require 'vendor/autoload.php';

use Turing\MultiplicationTuringMachine;

$m = new MultiplicationTuringMachine();
$m->activateDebugMode();
$m->multiplicate(decbin(13), decbin(17));
