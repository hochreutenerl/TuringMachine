<?php

namespace Turing;

/**
 * Klasse für das Band einer Turingmaschine
 */
class Tape
{
    private $content;
    private $position;

    /**
     * Initialisiert das Band
     * @param string      $content  Bandinhalt bei der Initialisierung
     * @param int|integer $position Position des Schreib- / Lesekopfs, Standard ganz links
     */
    public function __construct(string $content, int $position = 0)
    {
        $this->content = $content;
        $this->position = $position;
    }

    /**
     * Bewegt den Schreib- / Lesekopf in die angegebene Richtung
     * @param  string $movement Bewegungsrichtung, L = nach link, R = nach rechts
     */
    public function move(string $movement) {
        if($movement == "R") {
            $this->position++;
        } elseif($movement == "L") {
            $this->position--;
        }

        if($this->position > strlen($this->content) - 1) {
            $this->content .= TuringMachine::EMPTY_SYMBOL;
        }

        if($this->position < 0) {
            $this->position++;
            $this->content = TuringMachine::EMPTY_SYMBOL .$this->content;
        }

    }

    /**
     * Säubert den Bandinhalt von "leeren Zeichen" an den Enden
     */
    public function cleanUp() {
        while ($this->position > 0 and substr($this->content,0,1) == TuringMachine::EMPTY_SYMBOL) {
            $this->content = substr($this->content, 1);
            $this->position = $this->position--;
        }

        while ($this->position + 1 < strlen($this->content) and
            substr($this->content,-1,1) == TuringMachine::EMPTY_SYMBOL) {
            $this->content = substr($this->content,0, -1);
        }
    }

    /**
     * Liest das Symbol an der Position des Schreib- / Lesekopfs
     * @return string   Das Symbol an der Position des Schreib- / Lesekopfs
     */
    public function readSymbol() {
        return substr($this->content,$this->position,1);
    }

    /**
     * Schreibt das angegebene Symbol an die Position des Schreib- / Lesekopfs
     * @param  string Das zu schreibende Symbol
     */
    public function writeSymbol(string $symbol) {
        if($symbol != TuringMachine::NOT_EMPTY_SYMBOL_WILDCARD and $symbol != TuringMachine::ANY_SYMBOL_WILDCARD) {
            $this->content[$this->position] = $symbol;
        }
    }

    /**
     * Gibt die Position des Schreib- / Lesekopfs und den Bandinhalt zurück
     * @param  int|integer $maxDistanceFromPointer Anzeigedistanz von der Positions des Schreib- / Lesekopfs
     * @return string                              Statusmeldung
     */
    public function printStatus(int $maxDistanceFromPointer = 15) {
        $marginRight = $maxDistanceFromPointer + $this->position - strlen($this->content) + 1;
        $marginLeft = $maxDistanceFromPointer - $this->position;

        if($marginRight < 1) $marginRight = 1;
        if($marginLeft < 1) $marginLeft = 1;

        $status =  "Position: ".str_repeat(" ", $this->position + $marginLeft)."V\n";
        $status .= "Inhalt:   ".str_repeat(TuringMachine::EMPTY_SYMBOL, $marginLeft).
            $this->content.
            str_repeat(TuringMachine::EMPTY_SYMBOL, $marginRight)."\n";
        return $status;
    }

    /**
     * Gibt die Position des Schreib- / Lesekopfs zurück
     * @return int Position des Schreib- / Lesekopfs zurück
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Gibt den Bandinhalt zurück
     * @return string Bandinhalt
     */
    public function getContent() {
        return $this->content;
    }

}