<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Support\Filters\Doubler;

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
        /**
         * @var mixed
         */
        $i = $parameters->get("i");

        $terminal->write(
            (string) $i
        );

        return 0;
    }
}
