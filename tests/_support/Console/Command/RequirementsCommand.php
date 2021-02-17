<?php

namespace Tests\Console\Command;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

class RequirementsCommand extends Command
{
    public function getName() : string
    {
        return "requirements";
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        return 0;
    }
}
