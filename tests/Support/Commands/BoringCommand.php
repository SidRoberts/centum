<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("boring")]
class BoringCommand extends Command
{
    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        return self::SUCCESS;
    }
}
