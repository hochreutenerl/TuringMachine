<?php

/**
 * Klasse für das Band einer Turingmaschine
 */
class Tape
{
    const EMPTY_CHAR = "-";
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

        if($this->position > strlen($this->content) - 1) {
            $this->content .= self::EMPTY_CHAR;
        }

        if($this->position < 0) {
            $this->position++;
            $this->content = self::EMPTY_CHAR.$this->content;
        }

    }

    public function readSymbol() {
        return substr($this->content,$this->position,1);
    }

    public function writeSymbol($symbol) {
        $this->content[$this->position] = $symbol;
    }

    public function printStatus() {
        $status =  "Position:   ".str_repeat(" ", $this->position)."V\n";
        $status .= "Bandinhalt: ".$this->content."\n";
        return $status;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getContent() {
        return $this->content;
    }
}