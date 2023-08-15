---
layout: default
title: Console
parent: Components
has_children: true
permalink: console
---



# `Centum\Console`

The Console component can be used to easily develop command line applications.

Application endpoints are treated as [`Centum\Console\Command`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command.php) objects.
These Commands contain all of the code and all of the metadata is stored in a [`Centum\Console\CommandMetadata`](https://github.com/SidRoberts/centum/blob/development/src/Console/CommandMetadata.php) object.

[`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php) extracts the command name from `$argv`, finds the appropriate Command, and then executes the Command's code.

{: .highlight }
[`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php) implements [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ApplicationInterface.php).

```php
Centum\Console\Application(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

- `public function getCommandMetadata(string $commandClass): Centum\Console\CommandMetadata`
- `public function addCommand(string $commandClass): void`
- `public function getCommands(): array<string, string>`
- `public function addExceptionHandler(class-string $exceptionClass, string $commandClass): void`
- `public function handle(Centum\Interfaces\Console\TerminalInterface $terminal): int`



## Default Commands

*The following code snippets assume that the console application will be stored in `cli.php`.*

### [`Centum\Console\Command\ListCommand`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command/ListCommand.php)

Will list all registered `Centum\Console\Command` objects:

```bash
php cli.php list
```

### [`Centum\Console\Command\QueueConsumeCommand`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command/QueueConsumeCommand.php)

Will take the next available Task from the Queue and consume it ([see Queue docs](../queue/index.md)):

```bash
php cli.php queue-consume
```



## Exceptions

(all in the `Centum\Console\Exception` namespace)

- [`ArgvNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/ArgvNotFoundException.php)
- [`CommandMetadataNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandMetadataNotFoundException.php)
- [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)
- [`InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php)
- [`NotACommandException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/NotACommandException.php)
- [`NotAnExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/NotAnExceptionHandlerException.php)
- [`UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/UnsuitableExceptionHandlerException.php)
