<?php

class TuringMachine
{
    private $tapes = array();
    private $states = array();
    private $state;
    private $debugMode;

    /**
     * Konstruktor um eine neue Turingmaschine ins Leben zu rufen
     * @param $tapes Bänder der Turingmaschine
     * @param $states Zuständer der TM
     * @param $initialSate Anfangszustand der TM
     * @param $debugMode Debugingmodus aktiv oder nicht (default:false)
     */
    public function __construct($tapes, $states, $initialState, $debugMode = 0)
    {
        $this->tapes = $tapes;
        $this->states = $states;
        $this->state = $initialState;
        $this->debugMode = $debugMode;
    }

    public function runStep() {
        /**
         * @todo Implement Run Step
         */

        if($this->debugMode) {
            echo $this->printStatus();
        }
    }

    public function printStatus() {
        /**
         * @todo Implement Print Status / Configuration
         */


    }

}