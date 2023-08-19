---
layout: default
title: Interfaces
parent: Console
grand_parent: Components
permalink: console/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Console` namespace)



## [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ApplicationInterface.php)

- `addCommand(string $commandClass): void`
- `getCommands(): array`
- `addExceptionHandler(string $exceptionHandlerClass): void`
- `handle(Centum\Interfaces\Console\TerminalInterface $terminal): int`



## [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/CommandInterface.php)

- `execute(Centum\Interfaces\Console\TerminalInterface $terminal): int`



## [`Centum\Interfaces\Console\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ExceptionHandlerInterface.php)

- `handle(Centum\Interfaces\Console\TerminalInterface $terminal, Throwable $throwable): void`



## [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/TerminalInterface.php)

- `getArguments(): Centum\Interfaces\Console\Terminal\ArgumentsInterface`
- `getStdIn(): resource`
- `getStdOut(): resource`
- `getStdErr(): resource`
- `write(string $string): void`
- `writeLine(string $string = ""): void`
- `writeList(array $list): void`
- `writeError(string $string): void`
- `writeErrorLine(string $string = ""): void`



## [`Centum\Interfaces\Console\Terminal\ArgumentsInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/Terminal/ArgumentsInterface.php)

- `getFilename(): string`
- `getCommandName(): string`
- `getParameters(): array`
- `getParameter(string $name, mixed $defaultValue = null): mixed`
- `hasParameter(string $name): bool`
- `toArray(): array`
