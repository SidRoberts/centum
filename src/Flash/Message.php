<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageInterface;

class Message implements MessageInterface
{
    public function __construct(
        protected readonly string $level,
        protected readonly string $text
    ) {
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
