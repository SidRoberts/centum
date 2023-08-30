<?php

namespace Centum\Console\Command;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("list", "Lists all available commands.")]
class ListCommand implements CommandInterface
{
    public function __construct(
        protected readonly ApplicationInterface $application
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $commands = $this->application->getCommands();

        $commandNames = array_keys($commands);

        sort($commandNames);

        $terminal->writeLine(
            sprintf(
                "%d commands found:",
                count($commandNames)
            )
        );

        $terminal->writeList($commandNames);

        return self::SUCCESS;
    }
}
