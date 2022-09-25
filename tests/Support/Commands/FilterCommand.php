<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
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

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        /** @var mixed */
        $i = $parameters->get("i");

        $terminal->write(
            (string) $i
        );

        return 0;
    }
}
