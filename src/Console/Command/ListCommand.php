<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ListCommand extends Command
{
    public function getName() : string
    {
        return "list";
    }

    public function getDescription() : string
    {
        return "Lists all available commands.";
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        $console = $container->get("console");

        $commands = $console->getCommands();

        $commandNames = array_keys($commands);

        $terminal->writeList($commandNames);

        return 0;
    }
}
