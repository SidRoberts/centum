<?php

namespace Centum\Flash;

class Message
{
    protected string $level;
    protected string $text;



    public function __construct(string $level, string $text)
    {
        $this->level = $level;
        $this->text = $text;
    }



    public function getLevel() : string
    {
        return $this->level;
    }

    public function getText() : string
    {
        return $this->text;
    }
}
