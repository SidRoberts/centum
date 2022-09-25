<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;
use Exception;

class ProblematicCommand extends Command
{
    public function getName(): string
    {
        return "problematic";
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        throw new Exception("I'm being difficult.");
    }
}
