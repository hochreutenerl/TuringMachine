<?php

namespace Turing;

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

    public function cleanUp() {
        while ($this->position > 0 and substr($this->content,0,1) == self::EMPTY_CHAR) {
            $this->content = substr($this->content, 1);
            $this->position = $this->position--;
        }

        while ($this->position + 1 < strlen($this->content) and substr($this->content,-1,1) == self::EMPTY_CHAR) {
            $this->content = substr($this->content,0, -1);
        }
    }

    public function readSymbol() {
        return substr($this->content,$this->position,1);
    }

    public function writeSymbol($symbol) {
        if($symbol != "X" and $symbol != "?") {
            $this->content[$this->position] = $symbol;
        }
    }

    public function printStatus($maxDistanceFromPointer = 15) {
        $marginRight = $maxDistanceFromPointer + $this->position - strlen($this->content) + 1;
        $marginLeft = $maxDistanceFromPointer - $this->position;

        $status =  "Position: ".str_repeat(" ", $this->position + $marginLeft)."V\n";
        $status .= "Inhalt:   ".str_repeat(self::EMPTY_CHAR, $marginLeft).
            $this->content.
            str_repeat(self::EMPTY_CHAR, $marginRight)."\n";
        return $status;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getContent() {
        return $this->content;
    }

}