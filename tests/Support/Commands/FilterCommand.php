<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Tests\Support\Filters\Doubler;

class FilterCommand extends Command
{
    public function getName(): string
    {
        return "filter:double";
    }

    public function getFilters(ContainerInterface $container): array
    {
        return [
            "i" => new Doubler(),
        ];
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        /** @var mixed */
        $i = $parameters->get("i");

        $terminal->write(
            (string) $i
        );

        return 0;
    }
}
