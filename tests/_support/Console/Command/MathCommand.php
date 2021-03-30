<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

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

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
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
