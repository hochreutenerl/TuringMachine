<?php

namespace Turing;

/**
 * Diese Klasse repräsentiert einen Zustandsübergang in einer Turing Maschine   
 */
class Transition
{
    private $readSymbols;
    private $writeSymbols;
    private $movements;
    private $targetState;

    /**
     * Erstellt einen Zustandsübergang 
     * @param array      $readSymbols  Array der auf den Bändern gelesenen Zeichen
     * @param array      $writeSymbols Array der auf die Bänder zu schreibenden Zeichen
     * @param array      $movements    Array der Bewegungen der Schreib- / Leseköpfe der Bänder
     * @param State|null $targetState  Zielstatus, welcher nach dem Übergang angenommen wird
     */
    public function __construct(array $readSymbols, array $writeSymbols, array $movements, State $targetState = null)
    {
        $this->readSymbols = $readSymbols;
        $this->writeSymbols = $writeSymbols;
        $this->movements = $movements;
        $this->targetState = $targetState;
    }

    /**
     * Gibt die Lesesymbole zurück
     * @return array Lesesymbole dieses Übergangs
     */
    public function getReadSymbols() {
        return $this->readSymbols;
    }

    /**
     * Gibt die Schreibsymbole zurück
     * @return array Schreibsymbole dieses Übergangs
     */
    public function getWriteSymbols() {
        return $this->writeSymbols;
    }

    /**
     * Gibt die Bewegungen der Schreib- / Leseköpfe zurück
     * @return array Bewegungen der Schreib- / Leseköpfe
     */
    public function getMovements() {
        return $this->movements;
    }

    /**
     * Gibt den Zielzustand zurück
     * @return State Zielzustand dieses Übergans
     */
    public function getTargetState() {
        return $this->targetState;
    }
}