<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Exception;

class ProblematicCommand extends Command
{
    public function getName(): string
    {
        return "problematic";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        throw new Exception("I'm being difficult.");
    }
}
