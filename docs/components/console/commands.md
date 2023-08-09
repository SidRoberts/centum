---
layout: default
title: Commands
parent: Console
grand_parent: Components
permalink: console/commands
nav_order: 1
---



# Commands

A Command is responsible for providing the command name (`getName()`), middleware (`getMiddleware()`), parameter filters (`getFilters()`), and the actual code to run (`execute()`).
It's return value is the exit code.

Three constants exist to clearly describe an exit code:

- `Centum\Interfaces\Console\CommandInterface::SUCCESS = 0`
- `Centum\Interfaces\Console\CommandInterface::FAILURE = 1`
- `Centum\Interfaces\Console\CommandInterface::INVALID = 2`

{: .highlight }
[`Centum\Console\Command`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command.php) implements [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/CommandInterface.php).

- `public function getName(): string`
- `public function execute(Centum\Interfaces\Console\TerminalInterface $terminal, Centum\Interfaces\Container\ContainerInterface $container, Centum\Interfaces\Console\ParametersInterface $parameters): int`
- `public function getDescription(): string` (optional)
- `public function getHelp(): string` (optional)
- `public function getMiddleware(): Centum\Console\MiddlewareInterface` (optional)
- `public function getFilters(Centum\Interfaces\Container\ContainerInterface $container): array` (optional)

By default, a Command has no middleware or parameter filters and can be as simple as this:

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class IndexCommand extends Command
{
    public function getName(): string
    {
        return "this:is:your:name";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        $terminal->writeLine("hello");

        return self::SUCCESS;
    }
}
```

A Command's name must follow the pattern set out in the [Command Slug Validator](https://github.com/SidRoberts/centum/blob/development/src/Validator/CommandSlug.php).
To allow commands like `php cli.php`, empty names are allowed.

When the Application is processing a request, several Exceptions could be thrown:

- [`Centum\Console\Exception\InvalidFilterException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidFilterException.php) if `getFilters()` contains array elements that do not implement `FilterInterface`.
- [`Centum\Console\Exception\ParamNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/ParamNotFoundException.php) if `getFilters()` references a parameter that does not exist.



## Adding Commands to the Application

Commands can be added to the Application, using the `addCommand()` method:

```php
use App\Commands\IndexCommand;
use Centum\Interfaces\Console\ApplicationInterface;

/** @var ApplicationInterface $application */

$application->addCommand(
    new IndexCommand()
);
```

The Application will be able to determine Command's name from the Command's `getName()` method.
Commands are processed in the order that they are added to the Application but a later added Command can overwrite an older Command with the same name.

If the Command's name does not fit the standard described in the [Command Slug Validator](https://github.com/SidRoberts/centum/blob/development/src/Validator/CommandSlug.php), [`Centum\Console\Exception\InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php) will be thrown.
To allow commands like `php cli.php`, empty names are allowed.
