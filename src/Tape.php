<?php

class Tape
{
    private $content;
    private $position;

    public function __construct($content, $position = 0)
    {
        $this->content = $content;
        $this->position = $position;
    }

    public function move($movement) {
        if($movement == "R") {
            $this->position++;
        } elseif($movement == "L") {
            $this->position--;
        }

        if($this->position < strlen($this->content) - 1) {
            $this->content .= " ";
        }

        if($this->position < 0) {
            $this->position++;
            $this->content = " ".$this->content;
        }

    }

    public function readSymbol() {
        return substr($this->content,$this->position,1);
    }

    public function writeSymbol($symbol) {
        $this->content[$this->position] = $symbol;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getContent() {
        return $this->content;
    }
}