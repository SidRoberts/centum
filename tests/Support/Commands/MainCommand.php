<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class MainCommand extends Command
{
    public function getName(): string
    {
        return "";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        $terminal->write(
            "main page"
        );

        return self::SUCCESS;
    }
}
