<?php

namespace Tests\Support\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Tests\Support\ExitCode;

#[CommandMetadata("exit-code")]
class ExitCodeCommand extends Command
{
    public function __construct(
        protected readonly ExitCode $exitCode
    ) {
    }



    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        return $this->exitCode->getExitCode();
    }
}
