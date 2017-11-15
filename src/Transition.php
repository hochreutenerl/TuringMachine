<?php

class Transition
{
    private $readSymbol;
    private $writeTape;
    private $movement = "N";
    private $targetState;

    public function __construct($readSymbol, $writeSymbol, $movement = "N", $targetState = null)
    {
        $this->readSymbol = $readSymbol;
        $this->writeTape = $writeSymbol;
        $this->movement = $movement;
        $this->targetState = $targetState;
    }

    public function getReadSymbol() {
        return $this->readSymbol;
    }

    public function getWriteSymbol() {
        return $this->writeTape;
    }

    public function getMovement() {
        return $this->movement;
    }

    public function getTargetState() {
        return $this->targetState;
    }
}