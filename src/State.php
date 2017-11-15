<?php

/**
 * Klasse für den Zustand einer Turingmaschine
 */
class State
{
    private $name;
    private $transitions = array();
    private $is_accepting = false;

    public function __construct($name, $is_accepting = false)
    {
        $this->name = $name;
        $this->is_accepting = $is_accepting;
    }

    public function addTransition($transition) {
        $this->transitions[] = $transition;
    }

    public function getTransitionForSymbol($symbol) {
        foreach ($this->transitions as $transition) {
            if($transition->getReadSymbol() == $symbol) {
                return $transition;
            }
        }
        die("No Transition found");
    }

    public function isAccepting() {
        return $this->is_accepting;
    }

    public function getName() {
        return $this->name;
    }
}