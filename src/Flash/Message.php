<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageInterface;

class Message implements MessageInterface
{
    public function __construct(
        protected readonly Level $level,
        protected readonly string $text
    ) {
    }



    public function getLevel(): string
    {
        return $this->level->value;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
