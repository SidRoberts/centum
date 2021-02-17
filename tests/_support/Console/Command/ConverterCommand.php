<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Tests\Console\Converter\Doubler;

class ConverterCommand extends Command
{
    public function getName() : string
    {
        return "converter:double";
    }

    public function getConverters() : array
    {
        return [
            "i" => new Doubler(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        $terminal->write(
            $params["i"]
        );

        return 0;
    }
}
