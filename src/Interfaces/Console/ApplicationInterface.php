<?php

namespace Centum\Interfaces\Console;

interface ApplicationInterface
{
    /**
     * @param class-string $commandClass
     */
    public function addCommand(string $commandClass): void;

    /**
     * @return array<string, class-string>
     */
    public function getCommands(): array;



    /**
     * @param class-string $exceptionClass
     * @param class-string $commandClass
     */
    public function addExceptionHandler(string $exceptionClass, string $commandClass): void;



    public function handle(TerminalInterface $terminal): int;
}
