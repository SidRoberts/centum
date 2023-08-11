<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("https://github.com/")]
class BadNameCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        return self::SUCCESS;
    }
}
