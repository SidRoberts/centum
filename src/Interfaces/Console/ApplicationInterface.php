<?php

namespace Centum\Interfaces\Console;

interface ApplicationInterface
{
    public function addCommand(CommandInterface $command): void;

    public function getCommand(string $name): CommandInterface;

    /**
     * @return array<string, CommandInterface>
     */
    public function getCommands(): array;



    /**
     * @param class-string $exceptionClass
     */
    public function addExceptionHandler(string $exceptionClass, CommandInterface $command): void;



    public function handle(TerminalInterface $terminal): int;
}
