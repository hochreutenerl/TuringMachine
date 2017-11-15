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


}