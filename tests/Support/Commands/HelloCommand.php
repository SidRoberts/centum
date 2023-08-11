<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("hello")]
class HelloCommand implements CommandInterface
{
    public function __construct(
        protected readonly string $name,
        protected readonly bool $loud,
        protected readonly bool $backwards
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $message = "Hello {$this->name}!";

        if ($this->loud) {
            $message = strtoupper($message);
        }

        if ($this->backwards) {
            $message = strrev($message);
        }

        $terminal->writeLine($message);

        return self::SUCCESS;
    }
}
