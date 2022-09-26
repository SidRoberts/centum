<?php

namespace Centum\Console\Command;

use Centum\Console\Application;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

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

    public function execute(TerminalInterface $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $application = $container->get(Application::class);

        $commands = $application->getCommands();

        /** @var list<string> */
        $commandNames = array_keys($commands);

        sort($commandNames);

        $terminal->writeList($commandNames);

        return 0;
    }
}
