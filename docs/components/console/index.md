---
layout: default
title: Console
parent: Components
has_children: true
permalink: console
---



# `Centum\Console`

The Console component makes it easy to develop command line applications in Centum.

Application endpoints are treated as [`Centum\Console\Command`](https://github.com/SidRoberts/centum/blob/main/src/Console/Command.php) objects.
These Commands contain all of the code and all of the metadata is stored in a [`Centum\Console\CommandMetadata`](https://github.com/SidRoberts/centum/blob/main/src/Console/CommandMetadata.php) object.

[`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/main/src/Console/Application.php) extracts the command name from `$argv`, finds the appropriate Command, and then executes the Command's code.

{: .highlight }
[`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/main/src/Console/Application.php) implements [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/ApplicationInterface.php).



## Constructor

```php
Centum\Console\Application(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

- `getCommandMetadata(class-string<Centum\Interfaces\Console\CommandInterface> $commandClass): Centum\Console\CommandMetadata`
  Retrieve metadata for a command.
- `addCommand(class-string<Centum\Interfaces\Console\CommandInterface> $commandClass): void`
  Register a new command.
- `getCommands(): array<string, class-string<Centum\Interfaces\Console\CommandInterface>>`
  List all registered commands.
- `addExceptionHandler(class-string<Centum\Interfaces\Console\ExceptionHandlerInterface> $exceptionClass): void`
  Register an exception handler for console errors.
- `handle(Centum\Interfaces\Console\TerminalInterface $terminal): int`
  Run the console application.



## Default Commands

*The following code snippets assume that the console application will be stored in `cli.php`.*

### [`Centum\Console\Command\ListCommand`](https://github.com/SidRoberts/centum/blob/main/src/Console/Command/ListCommand.php)

Will list all registered `Centum\Console\Command` objects:

```bash
php cli.php list
```

### [`Centum\Console\Command\QueueConsumeCommand`](https://github.com/SidRoberts/centum/blob/main/src/Console/Command/QueueConsumeCommand.php)

Will take the next available Task from the Queue and consume it ([see Queue docs](../queue/index.md)):

```bash
php cli.php queue:consume
```



## Example: Defining a Custom Command

```php
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("greet")]
class GreetCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        $terminal->writeLine("Hello from Centum Console!");

        return self::SUCCESS;
    }
}
```
