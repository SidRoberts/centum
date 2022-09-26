---
layout: default
title: Console
parent: Components
has_children: true
permalink: console
---



# `Centum\Console`

```php
Centum\Console\Application(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

- `public function addCommand(Centum\Interfaces\Console\CommandInterface $command): void`
- `public function getCommand(string $name): Centum\Interfaces\Console\CommandInterface`
- `public function getCommands(): array<string, Centum\Interfaces\Console\CommandInterface>`
- `public function addExceptionHandler(class-string $exceptionClass, Centum\Interfaces\Console\CommandInterface $command): void`
- `public function handle(Centum\Interfaces\Console\TerminalInterface $terminal): int`

The Console component can be used to easily develop command line applications.

Application endpoints are treated as [Command](https://github.com/SidRoberts/centum/blob/development/src/Console/Command.php) objects.
These Commands contain all of the code and metadata relating to that endpoint.

The [Application](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php) extracts the command name from `$argv`, finds the appropriate Command, runs the Middlewares, and then executes the Command's code.



## Default Commands

*The following code snippets assume that the console application will be stored in `cli.php`.*

### [`Centum\Console\Command\ListCommand`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command/ListCommand.php)

Will list all registered Commands:

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

- [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)
- [`InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php)
- [`InvalidFilterException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidFilterException.php)
- [`ParamNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/ParamNotFoundException.php)
