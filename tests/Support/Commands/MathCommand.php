<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Container\ContainerInterface;

class MathCommand extends Command
{
    public function getName(): string
    {
        return "math:add";
    }

    public function getParams(): array
    {
        return [
            "a" => "int",
            "b" => "int",
        ];
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $a = (int) $parameters->get("a");
        $b = (int) $parameters->get("b");

        $terminal->write(
            sprintf(
                "%d+%d=%d",
                $a,
                $b,
                $a + $b
            )
        );

        return 0;
    }
}
