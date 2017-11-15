<?php

namespace Turing;

/**
 * Klasse für den Zustand einer Turingmaschine
 */
class State
{
    private $name;
    private $transitions = array();
    private $isAccepting = false;

    public function __construct($name, $isAccepting = false)
    {
        $this->name = $name;
        $this->isAccepting = $isAccepting;
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
            if($symbol == TuringMachine::ANY_SYMBOL_WILDCARD) {

            } elseif ($symbol == TuringMachine::NOT_EMPTY_SYMBOL_WILDCARD) {
                if($symbols2[$i] == TuringMachine::EMPTY_SYMBOL) {
                    return false;
                }
            } elseif($symbol != $symbols2[$i]) {
                return false;
            }
        }
        return true;
    }

    public function isAccepting() {
        return $this->isAccepting;
    }

    public function getName() {
        return $this->name;
    }
}