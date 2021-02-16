<?php

namespace Centum\Console\Command;

use Centum\Console\Application;
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
        $console = $container->typehintClass(Application::class);

        $commands = $console->getCommands();

        $commandNames = array_keys($commands);

        $terminal->writeList($commandNames);

        return 0;
    }
}
