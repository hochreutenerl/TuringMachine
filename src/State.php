<?php

namespace Turing;

/**
 * Diese Klasse bildet einen Zustand der Turing-Maschine ab
 */
class State
{
    private $name;
    private $transitions = array();
    private $isAccepting = false;

    /**
     * Erstellt einen Zustand, der in einer Turing-Maschine verwendet werden kann
     * @param string       $name        Name des Zustandes
     * @param bool|boolean $isAccepting Ob der Zustand akzeptierend ist.
     */
    public function __construct(string $name, bool $isAccepting = false)
    {
        $this->name = $name;
        $this->isAccepting = $isAccepting;
    }

    /**
     * Fügt einen Übergang zu diesem Zustand hinzu.
     * @param Transition $transition Der hinzuzufügende Übergang.
     */
    public function addTransition(Transition $transition) {
        $this->transitions[] = $transition;
    }

    /**
     * Findet den passenden nächsten Übergang, ausgehend von den übergebenen Symbolen
     * @param  array  $symbols Array der Lesesymbole, welche der gesucht Übergang enthalten muss
     * @return Transition          Jener Übergang, auf welchen die Lesesymbole zutreffen
     */
    public function getTransitionForSymbols(array $symbols) {
        foreach ($this->transitions as $transition) {
            $transitionSymbols = $transition->getReadSymbols();
            if($this->compareSymbols($transitionSymbols, $symbols)) {
                return $transition;
            }
        }
        die("Die Turing-Maschine hat keinen Übergang gefunden und ist im Abfallzustand gelandet.");
    }

    /**
     * Vergleicht die Symbole unter Beachtung der Wildcards von zwei Arrays
     * @param  array  $symbols1 Erster Vergleichsoperand
     * @param  array  $symbols2 Zweiter Vergleichsoperand
     * @return bool           true wenn die beiden Operanden übereinstimmen, ansonsten false
     */
    private function compareSymbols(array $symbols1, array $symbols2) {
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

    /**
     * Gibt zurück, ob der Zustand akzeptierend ist.
     * @return boolean true, wenn der aktuelle Zustand akzeptierend ist, ansonsten false
     */
    public function isAccepting() {
        return $this->isAccepting;
    }

    /**
     * Gibt den Namen des Status zurück
     * @return string Name dieses Status
     */
    public function getName() {
        return $this->name;
    }
}