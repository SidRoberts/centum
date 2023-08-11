---
layout: default
title: Commands
parent: Console
grand_parent: Components
permalink: console/commands
nav_order: 1
---



# Commands

A Command is responsible for providing the actual code to run (`execute()`).
It's return value is the exit code.

Three constants exist to clearly describe an exit code:

- `Centum\Interfaces\Console\CommandInterface::SUCCESS = 0`
- `Centum\Interfaces\Console\CommandInterface::FAILURE = 1`
- `Centum\Interfaces\Console\CommandInterface::INVALID = 2`

The [`CommandMetadata`](https://github.com/SidRoberts/centum/blob/development/src/Console/CommandMetadata.php) attribute class stores the name and description of the Command.
This is separated so that this information can be validated without instantiating the Command.

{: .highlight }
[`Centum\Console\Command`](https://github.com/SidRoberts/centum/blob/development/src/Console/Command.php) implements [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/CommandInterface.php).

- `public function execute(Centum\Interfaces\Console\TerminalInterface $terminal, Centum\Interfaces\Console\ParametersInterface $parameters): int`

By default, a Command can be as simple as this:

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("this:is:your:name")]
class IndexCommand extends Command
{
    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        $terminal->writeLine("hello");

        return self::SUCCESS;
    }
}
```

A Command's name must follow a slug pattern - all lowercase, alphanumeric with dashes, and must begin and end with alphanumeric characters.
To allow commands like `php cli.php`, empty names are allowed.



## Injecting Services into the Application

Services can be injected from the Container through the constructor method:

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Filter\String\ToUpper;

#[CommandMetadata("this:is:your:name")]
class IndexCommand extends Command
{
    public function __construct(
        protected readonly ToUpper $toUpperFilter
    ) {
    }

    public function execute(TerminalInterface $terminal, ParametersInterface $parameters): int
    {
        // Will output "HELLO"
        $terminal->writeLine(
            $this->toUpperFilter->filter("hello")
        );

        return self::SUCCESS;
    }
}
```



## Adding Commands to the Application

Commands can be added to the Application, using the `addCommand()` method:

```php
use App\Commands\IndexCommand;
use Centum\Interfaces\Console\ApplicationInterface;

/** @var ApplicationInterface $application */

$application->addCommand(IndexCommand::class);
```

The Application will be able to determine Command's name from the CommandMetadata attribute.
Commands are processed in the order that they are added to the Application but a later added Command can overwrite an older Command with the same name.

If the Command's name is not valid, then an [`Centum\Console\Exception\InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php) will be thrown.
