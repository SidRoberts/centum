<?php

namespace Centum\Console\Command;

use Centum\Console\Application;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ListCommand extends Command
{
    public function getName(): string
    {
        return "list";
    }

    public function getDescription(): string
    {
        return "Lists all available commands.";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $console = $container->typehintClass(Application::class);

        $commands = $console->getCommands();

        /**
         * @var list<string>
         */
        $commandNames = array_keys($commands);

        sort($commandNames);

        $terminal->writeList($commandNames);

        return 0;
    }
}
