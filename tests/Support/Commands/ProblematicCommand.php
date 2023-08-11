<?php

namespace Tests\Support\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Exception;

#[CommandMetadata("problematic")]
class ProblematicCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        throw new Exception("I'm being difficult.");
    }
}
