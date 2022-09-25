<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;

class MainCommand extends Command
{
    public function getName(): string
    {
        return "";
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $terminal->write(
            "main page"
        );

        return 0;
    }
}
