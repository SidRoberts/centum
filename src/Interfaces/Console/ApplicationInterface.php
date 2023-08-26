<?php

namespace Centum\Interfaces\Console;

interface ApplicationInterface
{
    /**
     * @param class-string<CommandInterface> $commandClass
     */
    public function addCommand(string $commandClass): void;

    /**
     * @return array<string, class-string<CommandInterface>>
     */
    public function getCommands(): array;



    /**
     * @param class-string<ExceptionHandlerInterface> $exceptionHandlerClass
     */
    public function addExceptionHandler(string $exceptionHandlerClass): void;



    public function handle(TerminalInterface $terminal): int;
}
