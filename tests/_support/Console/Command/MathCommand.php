<?php

namespace Centum\Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

class MathCommand extends Command
{
    public function getName() : string
    {
        return "math:add";
    }

    public function getParams() : array
    {
        return [
            "a" => "int",
            "b" => "int",
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        $a = $params["a"];
        $b = $params["b"];

        $terminal->write(
            $a + $b
        );

        return 0;
    }
}
