<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;

class BoringCommand extends Command
{
    public function getName(): string
    {
        return "boring";
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
