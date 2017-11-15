<?php

class State
{
    private $transitions = array();
    private $is_accepting = false;

    public function __construct($transitions, $is_accepting = false)
    {
        $this->transitions = $transitions;
        $this->is_accepting = $is_accepting;
    }
}