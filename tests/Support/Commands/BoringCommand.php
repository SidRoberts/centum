<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class BoringCommand extends Command
{
    public function getName(): string
    {
        return "boring";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        return 0;
    }
}
