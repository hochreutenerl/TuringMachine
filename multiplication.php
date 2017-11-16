<?php

$loader = require 'vendor/autoload.php';

use Turing\MultiplicationTuringMachine;

$m = new MultiplicationTuringMachine();
$m->multiplicate("1011", "1010");
