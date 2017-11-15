<?php

class TuringMachine
{
    private $tapes = array();
    private $states = array();
    private $state;
    private $debugMode;

    private $steps = 0;

    /**
     * Konstruktor um eine neue Turingmaschine ins Leben zu rufen
     * @param $tapes array  Bänder der Turingmaschine
     * @param $states array Zuständer der TM
     * @param $initialState  State   Anfangszustand der TM
     * @param $debugMode    boolean Debugingmodus aktiv oder nicht (default:false)
     */
    public function __construct($tapes, $states, $initialState, $debugMode = 0)
    {
        $this->tapes = $tapes;
        $this->states = $states;
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

        $tape = $this->tapes[0];
        $currentSymbol = $tape->readSymbol();
        $nextTransition = $this->state->getTransitionForSymbol($currentSymbol);
        $tape->writeSymbol($nextTransition->getWriteSymbol());
        $tape->move($nextTransition->getMovement());
        $this->state = $nextTransition->getTargetState();

        if($this->debugMode) {
            echo $this->printStatus();
        }
    }

    /**
     * @return bool returns true if machine is in an accepted state
     */
    public function isInAcceptedState() {
        return $this->state->isAccepting();
    }

    public function printStatus() {
        /**
         * @todo Implement Print Status / Configuration
         */

        $status = "";
        $status .= "Aktueller Status: ".$this->state->getName()."\n";
        foreach ($this->tapes as $i => $tape) {
            $status .= "Bandinhalt Band Nr. $i:   ".$tape->getContent()."\n";
            $status .= "Position auf Band Nr. $i: ".str_repeat(" ", $tape->getPosition())."|\n";
        }
        $status .= "Benötigte Schritte: $this->steps\n";
        $status .= "\n";

        return $status;
    }

}