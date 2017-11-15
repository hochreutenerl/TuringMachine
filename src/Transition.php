<?php

class Transition
{
    private $readTape;
    private $writeTape;
    private $movement = "N";
    private $targetState;

    public function __construct($readTape, $writeTape, $movement = "N", $targetState = null)
    {
        $this->readTape = $readTape;
        $this->writeTape = $writeTape;
        $this->movement = $movement;
        $this->targetState = $targetState;
    }
}