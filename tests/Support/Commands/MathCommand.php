<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Filter\Cast\ToInteger;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class MathCommand extends Command
{
    public function getName(): string
    {
        return "math:add";
    }

    public function getFilters(ContainerInterface $container): array
    {
        return [
            "a" => $container->get(ToInteger::class),
            "b" => $container->get(ToInteger::class),
        ];
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        /** @var int */
        $a = $parameters->get("a");

        /** @var int */
        $b = $parameters->get("b");

        $terminal->write(
            sprintf(
                "%d+%d=%d",
                $a,
                $b,
                $a + $b
            )
        );

        return self::SUCCESS;
    }
}
