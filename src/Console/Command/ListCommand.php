<?php

namespace Centum\Console\Command;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("list", "Lists all available commands.")]
class ListCommand extends Command
{
    public function __construct(
        protected readonly ApplicationInterface $application
    ) {
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        $commands = $this->application->getCommands();

        $commandNames = array_keys($commands);

        sort($commandNames);

        $terminal->writeList($commandNames);

        return self::SUCCESS;
    }
}
