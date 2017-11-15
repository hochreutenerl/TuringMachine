<?php


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

    /**
     * Konstruktor um eine neue Turingmaschine ins Leben zu rufen
     * @param $tapes array  Bänder der Turingmaschine
     * @param $initialState  State   Anfangszustand der TM
     * @param $debugMode    boolean Debugingmodus aktiv oder nicht (default:false)
     */
    public function __construct($tapes, $initialState, $debugMode = 0)
    {
        $this->tapes = $tapes;
        $this->state = $initialState;
        $this->debugMode = $debugMode;
    }

    public function run() {
        while(!$this->isInAcceptedState()) {
            $this->runStep();
        }
        echo "Die Turing-Maschine ist in einem akzeptierten Zustand angekommen:\n";
        echo $this->printStatus();
    }

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

    private function readSymbols() {
        $symbols = array();
        foreach ($this->tapes as $tape) {
            $symbols[] = $tape->readSymbol();
        }
        return $symbols;
    }

    /**
     * @return bool returns true if machine is in an accepted state
     */
    public function isInAcceptedState() {
        return $this->state->isAccepting();
    }

    public function printStatus() {
        $status = "";
        $status .= "Aktueller Status: ".$this->state->getName()."\n";
        foreach ($this->tapes as $i => $tape) {
            $status .= "Band $i: \n";
            $status .= $tape->printStatus();
        }
        $status .= "Benötigte Schritte: $this->steps\n";
        $status .= "\n";

        return $status;
    }

}