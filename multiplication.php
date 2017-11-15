<?php

require 'src/TuringMachine.php';
require 'src/State.php';
require 'src/Transition.php';
require 'src/Tape.php';

$q_0 = new State("Startzustand: bewege Band 0 nach rechts");
$q_0b = new State("Startzustand: bewege Band 1 nach rechts");
$q_0c = new State("Startzustand: bewege Band 2 nach rechts");

$q_1 = new State("Hänge 0 an Input 2 an");
$q_1a = new State("Verarbeite Symbol von Input 1");

$q_2 = new State("Addiere Input 1 zum Resultat, wir haben keinen Übertrag");
$q_2carry = new State("Addiere Input 1 zum Resultat, wir haben einen Übertrag");

$q_3 = new State("Addition beendet");

$q_4 = new State("Multiplikation beendet", true);

/*
 * Hier verschieben wir alle Pointer ans Ende
 */
$q_0->addTransition(new Transition(["X","?","?"],["X","?","?"],["R","N","N"], $q_0));
$q_0->addTransition(new Transition(["-","?","?"],["X","?","?"],["N","N","N"], $q_0b));

$q_0b->addTransition(new Transition(["?","X","?"],["?","X","?"],["N","R","N"], $q_0b));
$q_0b->addTransition(new Transition(["?","-","?"],["?","X","?"],["N","N","N"], $q_0c));

$q_0c->addTransition(new Transition(["?","?","X"],["?","?","X"],["N","N","R"], $q_0c));
$q_0c->addTransition(new Transition(["?","?","-"],["?","?","X"],["N","N","N"], $q_1));


$q_1->addTransition(new Transition(["-","-","-"],["?","0","?"],["L","L","N"], $q_1a));

/*
 * Hier entscheidet sich, ob eine Addition vorgenommmen wird / weitergerechnet / terminiert wird
 */
$q_1a->addTransition(new Transition(["0","?","?"],["-","?","?"],["L","N","N"], $q_0));
$q_1a->addTransition(new Transition(["1","?","?"],["-","?","?"],["N","N","L"], $q_2));
$q_1a->addTransition(new Transition(["-","?","?"],["-","?","?"],["N","N","N"], $q_4));

/*
 * Berechnung der Addition
 */
$q_2->addTransition(new Transition(["?","0","0"],["?","?","0"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition(["?","0","1"],["?","?","1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition(["?","1","0"],["?","?","1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition(["?","1","1"],["?","?","0"],["N","L","L"], $q_2carry));
$q_2->addTransition(new Transition(["?","0","-"],["?","?","0"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition(["?","-","0"],["?","?","0"],["N","N","L"], $q_2));
$q_2->addTransition(new Transition(["?","1","-"],["?","?","1"],["N","L","L"], $q_2));
$q_2->addTransition(new Transition(["?","-","1"],["?","?","1"],["N","N","L"], $q_2));

$q_2carry->addTransition(new Transition(["?","0","0"],["?","?","1"],["L","L","L"], $q_2));
$q_2carry->addTransition(new Transition(["?","0","1"],["?","?","0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition(["?","1","0"],["?","?","0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition(["?","1","1"],["?","?","1"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition(["?","0","-"],["?","?","1"],["L","L","L"], $q_2));
$q_2carry->addTransition(new Transition(["?","1","-"],["?","?","0"],["L","L","L"], $q_2carry));
$q_2carry->addTransition(new Transition(["?","-","0"],["?","?","1"],["L","N","L"], $q_2));
$q_2carry->addTransition(new Transition(["?","-","1"],["?","?","0"],["L","N","L"], $q_2carry));

/*
 * Abschluss der Addition / Zurück in den Anfangszustand
 */
$q_2->addTransition(new Transition(["-","?","-"],["?","?","?"],["L","R","R"], $q_0));
$q_2carry->addTransition(new Transition(["-","?","-"],["?","?","1"],["L","R","R"], $q_0));



$initialState = $q_0;

$tapes = [
    new Tape("1001"), // Input Tape 1
    new Tape("1011"), // Input Tape 2
    new Tape("-") // Output Tape
];

$tm = new TuringMachine($tapes, $initialState, 1);
$tm->run();