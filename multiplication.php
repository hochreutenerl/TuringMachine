<?php

$loader = require 'vendor/autoload.php';

use Turing\MultiplicationTuringMachine;

$finished=false;
while(!$finished){
    $finished=getEingabe();
}

/**
 * Liest die Eingabe von der Kommandozeile aus und started ggF. einen Turingmaschine
 * zur Muiltiplikation selbiger
 */
function getEingabe()
{
    if(!defined("STDIN")) 
    {
        define("STDIN", fopen('php://stdin','rb'));
    }
    echo "Bitte die beiden zu multiplizierenden Zahlen für die Turingmaschine unten durch ein 'x' getrennt eingeben:\n";
    echo " (z.B. 2332x87478) Zahl muss jeweils kleiner als 10^10 sein \n Mit 'q' beenden Sie das Programm \n";
    $numbers=array(1, 1);
    $input=fread(STDIN, 21);
    $numbers=explode('x', trim($input)); 

    if($numbers[0] == "q")
    {
        return true;
    }
    //prüfe Eingabe
    if(count($numbers) != 2)
    {
        echo "! Bitte gültige Eingabe verwenden !\n";
        return false;
    } else 
    {
        $numbers[0]=(int)$numbers[0];
        $numbers[1]=(int)$numbers[1];
        echo $numbers[0]." wird mit ".$numbers[1]."multipliziert...\n";
        runTuringMachine($numbers[0], $numbers[1]);
        return false;
    }
}
/**
 * Startet die Turingmaschine
 * @param $zahl1 Zahl wird mit $zahl2 multipliziert
 * @param $zahl2 Zahl wird mit $zahl1 multipliziert
 */
function runTuringMachine($zahl1, $zahl2)
{
    $m = new MultiplicationTuringMachine();
    $m->activateDebugMode();
    $m->multiplicate($zahl1, $zahl2);
}