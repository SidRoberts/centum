<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageInterface;

class Message implements MessageInterface
{
    protected readonly string $level;
    protected readonly string $text;



    public function __construct(string $level, string $text)
    {
        $this->level = $level;
        $this->text  = $text;
    }



    public function getLevel(): string
    {
        return $this->level;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
