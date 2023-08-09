<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Exception;

#[CommandMetadata("problematic")]
class ProblematicCommand extends Command
{
    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        throw new Exception("I'm being difficult.");
    }
}
