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

    public function getTransitionForSymbols($symbols) {
        foreach ($this->transitions as $transition) {
            $transitionSymbols = $transition->getReadSymbols();
            if($this->compareSymbols($transitionSymbols, $symbols)) {
                return $transition;
            }
        }
        die("Die Turing-Maschine hat keinen Übergang gefunden und ist im Abfallzustand gelandet.");
    }

    private function compareSymbols($symbols1, $symbols2) {
        if(count($symbols1) != count($symbols2)) {
            return false;
        }
        foreach ($symbols1 as $i => $symbol) {
            if($symbol == "?") {

            } elseif ($symbol == "X") {
                if($symbols2[$i] == "-") {
                    return false;
                }
            } elseif($symbol != $symbols2[$i]) {
                return false;
            }
        }
        return true;
    }

    public function isAccepting() {
        return $this->is_accepting;
    }

    public function getName() {
        return $this->name;
    }
}