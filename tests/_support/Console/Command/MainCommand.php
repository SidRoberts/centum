<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class MainCommand extends Command
{
    public function getName() : string
    {
        return "";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters) : int
    {
        $terminal->write(
            "main page"
        );

        return 0;
    }
}
