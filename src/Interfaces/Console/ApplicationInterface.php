<?php

namespace Centum\Interfaces\Console;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

interface ApplicationInterface
{
    public function addCommand(CommandInterface $command): void;

    public function getCommand(string $name): CommandInterface;

    public function getCommands(): array;



    /**
     * @param class-string $exceptionClass
     */
    public function addExceptionHandler(string $exceptionClass, CommandInterface $command): void;



    public function handle(TerminalInterface $terminal): int;
}
