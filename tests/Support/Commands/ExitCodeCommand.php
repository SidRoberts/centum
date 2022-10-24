<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Console\ParametersInterface;

class ExitCodeCommand extends Command
{
    protected int $exitCode;



    public function __construct(int $exitCode)
    {
        $this->exitCode = $exitCode;
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
