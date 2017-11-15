<?php

namespace Turing;

class Transition
{
    private $readSymbols;
    private $writeSymbols;
    private $movements;
    private $targetState;

    public function __construct($readSymbols, $writeSymbols, $movements, $targetState = null)
    {
        $this->readSymbols = $readSymbols;
        $this->writeSymbols = $writeSymbols;
        $this->movements = $movements;
        $this->targetState = $targetState;
    }

    public function getReadSymbols() {
        return $this->readSymbols;
    }

    public function getWriteSymbols() {
        return $this->writeSymbols;
    }

    public function getMovements() {
        return $this->movements;
    }

    public function getTargetState() {
        return $this->targetState;
    }
}