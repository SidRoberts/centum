<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("")]
class MainCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        $terminal->write(
            "main page"
        );

        return self::SUCCESS;
    }
}
