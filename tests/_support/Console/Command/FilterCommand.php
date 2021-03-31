<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Filter\Doubler;

class FilterCommand extends Command
{
    public function getName(): string
    {
        return "filter:double";
    }

    public function getFilters(Container $container): array
    {
        return [
            "i" => new Doubler(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->write(
            $parameters->get("i")
        );

        return 0;
    }
}
