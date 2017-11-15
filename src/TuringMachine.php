<?php

class TuringMachine
{
    private $tapes = array();
    private $states = array();
    private $state;
    private $debugModus;

    private $steps = 0;

    public function __construct($tapes, $states, $intialState, $debugModus = 0)
    {
        $this->tapes = $tapes;
        $this->states = $states;
        $this->state = $intialState;
        $this->debugModus = $debugModus;
    }

    public function run() {
        while(!$this->isInAcceptedState()) {
            $this->runStep();
        }
        echo $this->printStatus();
    }

    public function runStep() {
        /**
         * @todo Implement Run Step
         */
        $this->steps++;

        if($this->debugModus) {
            echo $this->printStatus();
        }
    }

    public function isInAcceptedState() {
        /**
         * @todo returns true if machine is in an accepted state
         */
        return $this->state->isAccepting();
    }

    public function printStatus() {
        /**
         * @todo Implement Print Status / Configuration
         */

        $status = "Benötigte Schritte: $this->steps\n";
        return $status;
    }

}