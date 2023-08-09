<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class ExitCodeCommand extends Command
{
    public function __construct(
        protected readonly int $exitCode
    ) {
    }



    public function getName(): string
    {
        return "exit-code";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        return $this->exitCode;
    }
}
