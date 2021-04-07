<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Exception;

class ProblematicCommand extends Command
{
    public function getName(): string
    {
        return "problematic";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        throw new Exception("I'm being difficult.");
    }
}
