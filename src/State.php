<?php

class State
{
    private $transitions = array();
    private $is_accepting = false;

    public function __construct($transitions = array(), $is_accepting = false)
    {
        $this->transitions = $transitions;
        $this->is_accepting = $is_accepting;
    }

    public function addTransition($transition) {
        $this->transitions[] = $transition;
    }

    public function isAccepting() {
        return $this->is_accepting;
    }
}