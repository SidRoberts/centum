<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("boring")]
final class BoringCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        return self::SUCCESS;
    }
}
