<?php

namespace Turing;

/**
 * Turingmaschine zur Berechnung der Multiplikation
 * zweier ganzer positiven Zahlen.
 * Ausgabe: Korrektes Ergebnis
 * Aktueller Zustand
 * Band mit 15 Zellen vor und nach dem Lese- und Schreibkopf
 * Aktuelle Lese/Schreibkopf Position
 * Zähler der Berechnungsschritte
 * @author Luca H. Jonas R.
 * @version 0.1
 */
class TuringMachine
{
    private $tapes = array();
    private $state;
    private $debugMode;

    private $steps = 0;

    const EMPTY_SYMBOL = "-";
    const NOT_EMPTY_SYMBOL_WILDCARD = "X";
    const ANY_SYMBOL_WILDCARD = "?";

    /**
     * Konstruktor um eine neue Turingmaschine ins Leben zu rufen
     * @param $tapes array  Bänder der Turingmaschine
     * @param $initialState  State   Anfangszustand der TM
     * @param $debugMode    bool Debugingmodus aktiv oder nicht (default:false)
     */
    public function __construct(array $tapes, State $initialState, bool $debugMode = false)
    {
        $this->tapes = $tapes;
        $this->state = $initialState;
        $this->debugMode = $debugMode;
    }

    /**
     * Startet die Turingmaschine
     * Die Turingmaschine läuft, bis ein akzeptierter Zustand erreicht wird,
     * kein Übergangszustand gefunden werden kann oder ein Fehler auftritt
     */
    public function run() {
        while(!$this->isInAcceptedState()) {
            $this->runStep();
        }
        echo "Die Turing-Maschine ist in einem akzeptierten Zustand angekommen:\n";
        echo $this->printStatus();
    }

    /**
     * Lässt die Turingmaschine einen Berechnungsschritt machen
     */
    public function runStep() {
        $this->steps++;

        $currentSymbols = $this->readSymbols();
        $nextTransition = $this->state->getTransitionForSymbols($currentSymbols);
        foreach ($this->tapes as $i => $tape ){
            $tape->writeSymbol($nextTransition->getWriteSymbols()[$i]);
            $tape->move($nextTransition->getMovements()[$i]);
            $tape->cleanUp();
        }
        $this->state = $nextTransition->getTargetState();

        if($this->debugMode) {
            echo $this->printStatus();
        }
    }

    /**
     * Liest die Symbole von allen Bändern aus
     * @return array Array der Symbole auf den Bändern
     */
    private function readSymbols() {
        $symbols = array();
        foreach ($this->tapes as $tape) {
            $symbols[] = $tape->readSymbol();
        }
        return $symbols;
    }

    /**
     * Gibt zurück, ob die Maschine in einem akzeptierten Zustand ist
     * @return boolean true, wenn die Maschine in einem akzeptierten Zustand ist, ansonsten false
     */
    public function isInAcceptedState() {
        return $this->state->isAccepting();
    }

    /**
     * Gibt eine Meldung über den Status der Turingmaschine zurück.
     * @return string Aktuelle Statusmeldung
     */
    public function printStatus() {
        $status = "Aktueller Status: ".$this->state->getName()."\n";
        foreach ($this->tapes as $i => $tape) {
            $status .= "Band $i: \n";
            $status .= $tape->printStatus();
        }
        $status .= "Benötigte Schritte: $this->steps\n";
        $status .= "\n";

        return $status;
    }

    /**
     * Setzt die angegebenen Bänder in die Turing maschine ein
     * @param array $tapes Die zu setzenden Bänder
     */
    public function setTapes($tapes) {
        $this->tapes = $tapes;
    }

    /**
     * Deaktiviert den Debug / Schrittmodus
     */
    public function deactivateDegubMode() {
        $this->debugMode = false;
    }

    /**
     * Aktiviert den Debug / Schrittmodus
     */
    public function activateDebugMode() {
        $this->debugMode = true;
    }

}