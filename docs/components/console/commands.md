---
layout: default
title: Commands
parent: Console
grand_parent: Components
permalink: console/commands
nav_order: 1
---



# Commands

A Command functions similarly to a Controller in a web application.

{: .note }
Commands must implement [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/CommandInterface.php).

Commands only require one public method:

- `public function execute(Centum\Interfaces\Console\TerminalInterface $terminal): int`

The `execute()` method's return value is the exit code.
Three constants exist to clearly describe an exit code:

- `Centum\Interfaces\Console\CommandInterface::SUCCESS = 0`
- `Centum\Interfaces\Console\CommandInterface::FAILURE = 1`
- `Centum\Interfaces\Console\CommandInterface::INVALID = 2`

The [`CommandMetadata`](https://github.com/SidRoberts/centum/blob/development/src/Console/CommandMetadata.php) attribute class stores the name and description of the Command.
This is separated so that this information can be validated without instantiating the Command.

By default, a Command can be as simple as this:

```php
namespace App\Console\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("this:is:your:name")]
class IndexCommand implements CommandInterface
{
    public function execute(TerminalInterface $terminal): int
    {
        $terminal->writeLine("hello");

        return self::SUCCESS;
    }
}
```

A Command's name must follow a slug pattern - all lowercase, alphanumeric with dashes, and must begin and end with alphanumeric characters.
To allow commands like `php cli.php`, empty names are allowed.



## Command Arguments

Commands can take inputs in the form of arguments:

```bash
php cli.php hello --name Sid --loud
```

To access these arguments from within a Command, they need to be declared in the constructor with a type of `string` or `bool`:

```php
namespace App\Console\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("hello")]
class HelloCommand implements CommandInterface
{
    public function __construct(
        protected readonly string $name,
        protected readonly bool $loud
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $message = "Hello {$this->name}!";

        if ($this->loud) {
            $message = strtoupper($message);
        }

        $terminal->writeLine($message);

        return self::SUCCESS;
    }
}
```

Arguments are converted to camel-case so `--first-name` will become `$firstName` in the constructor.



## Injecting Services into the Application

Services from the Container can also be injected through the constructor method:

```php
namespace App\Console\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Clock\ClockInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("hello")]
class HelloCommand implements CommandInterface
{
    public function __construct(
        protected readonly string $name,
        protected readonly ClockInterface $clock
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $terminal->writeLine("Hello {$this->name}!");

        $now = $this->clock->now();

        $terminal->writeLine("The time is now {$now->format("H:i:s")} in {$now->format("e")}.");

        return self::SUCCESS;
    }
}
```



## Adding Commands to the Application

Commands can be added to the Application, using the `addCommand()` method:

```php
use App\Console\Commands\IndexCommand;
use Centum\Interfaces\Console\ApplicationInterface;

/** @var ApplicationInterface $application */

$application->addCommand(IndexCommand::class);
```

The Application will be able to determine Command's name from the CommandMetadata attribute.
Commands are processed in the order that they are added to the Application but a later added Command can overwrite an older Command with the same name.

If the Command's name is not valid, then an [`Centum\Console\Exception\InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php) will be thrown.
