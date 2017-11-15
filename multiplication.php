<?php

$loader = require 'vendor/autoload.php';

use Turing\Tape;
use Turing\State;
use Turing\Transition;
use Turing\TuringMachine;

$q_0 = new State("Bewege Band 0 nach rechts");
$q_0b = new State("Bewege Band 1 nach rechts");
$q_0c = new State("Bewege Band 2 nach rechts");

$q_1 = new State("Hänge 0 an Input 2 an");
$q_1a = new State("Verarbeite Symbol von Input 1");

$q_2 = new State("Addiere Input 1 zum Resultat, wir haben keinen Übertrag");
$q_2carry = new State("Addiere Input 1 zum Resultat, wir haben einen Übertrag");

$q_3 = new State("Addition beendet");

$q_4 = new State("Multiplikation beendet", true);

$e = TuringMachine::EMPTY_SYMBOL;
$ne = TuringMachine::NOT_EMPTY_SYMBOL_WILDCARD;
$s = TuringMachine::ANY_SYMBOL_WILDCARD;

/*
 * Hier verschieben wir alle Pointer ans Ende
 */
$q_0->addTransition(new Transition([$ne,$s,$s],[$ne,$s,$s],["R","N","N"], $q_0));
$q_0->addTransition(new Transition([$e,$s,$s],[$ne,$s,$s],["N","N","N"], $q_0b));

$q_0b->addTransition(new Transition([$s,$ne,$s],[$s,$ne,$s],["N","R","N"], $q_0b));
$q_0b->addTransition(new Transition([$s,$e,$s],[$s,$ne,$s],["N","N","N"], $q_0c));

$q_0c->addTransition(new Transition([$s,$s,$ne],[$s,$s,$ne],["N","N","R"], $q_0c));
$q_0c->addTransition(new Transition([$s,$s,$e],[$s,$s,$ne],["N","N","N"], $q_1));


$q_1->addTransition(new Transition([$e,$e,$e],[$s,"0",$s],["L","L","N"], $q_1a));

/*
 * Hier entscheidet sich, ob eine Addition vorgenommmen wird / weitergerechnet / terminiert wird
 */
$q_1a->addTransition(new Transition(["0",$s,$s],[$e,$s,$s],["L","N","N"], $q_0));
$q_1a->addTransition(new Transition(["1",$s,$s],[$e,$s,$s],["N","N","L"], $q_2));
$q_1a->addTransition(new Transition([$e,$s,$s],[$e,$s,$s],["N","N","N"], $q_4));

/*
 * Berechnung der Addition
 */
$q_2->addTransition(new Transition([$s,"0","0"],[$s,$s,"0"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition([$s,"0","1"],[$s,$s,"1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition([$s,"1","0"],[$s,$s,"1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition([$s,"1","1"],[$s,$s,"0"],["N","L","L"], $q_2carry));
$q_2->addTransition(new Transition([$s,"0",$e],[$s,$s,"0"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition([$s,$e,"0"],[$s,$s,"0"],["N","N","L"], $q_2));
$q_2->addTransition(new Transition([$s,"1",$e],[$s,$s,"1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition([$s,$e,"1"],[$s,$s,"1"],["N","N","L"], $q_2));

$q_2carry->addTransition(new Transition([$s,"0","0"],[$s,$s,"1"],["L","L","L"], $q_2));
$q_2carry->addTransition(new Transition([$s,"0","1"],[$s,$s,"0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition([$s,"1","0"],[$s,$s,"0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition([$s,"1","1"],[$s,$s,"1"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition([$s,"0",$e],[$s,$s,"1"],["L","L","L"], $q_2));
$q_2carry->addTransition(new Transition([$s,"1",$e],[$s,$s,"0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition([$s,$e,"0"],[$s,$s,"1"],["L","N","L"], $q_2));
$q_2carry->addTransition(new Transition([$s,$e,"1"],[$s,$s,"0"],["L","N","L"], $q_2carry));

/*
 * Abschluss der Addition / Zurück in den Anfangszustand
 */
$q_2->addTransition(new Transition([$e,$s,$e],[$s,$s,$s],["L","R","R"], $q_0));
$q_2carry->addTransition(new Transition([$e,$s,$e],[$s,$s,"1"],["L","R","R"], $q_0));

$initialState = $q_0;

$tapes = [
    new Tape("1001"), // Input Tape 1
    new Tape("1011"), // Input Tape 2
    new Tape($e) // Output Tape
];

$tm = new TuringMachine($tapes, $initialState, 1);
$tm->run();