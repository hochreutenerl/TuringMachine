<?php

class TuringMachine
{
    private $tapes = array();
    private $states = array();
    private $state;
    private $debugModus;

    public function __construct($tapes, $states, $intialState, $debugModus = 0)
    {
        $this->tapes = $tapes;
        $this->states = $states;
        $this->state = $intialState;
        $this->debugModus = $debugModus;
    }

    public function runStep() {
        /**
         * @todo Implement Run Step
         */

        if($this->debugModus) {
            echo $this->printStatus();
        }
    }

    public function printStatus() {
        /**
         * @todo Implement Print Status / Configuration
         */


    }

}