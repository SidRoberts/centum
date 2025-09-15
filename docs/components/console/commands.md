---
layout: default
title: Commands
parent: Console
grand_parent: Components
permalink: console/commands
nav_order: 1
---



# Commands

A Command in Centum functions similarly to a Controller in a web application, providing an entry point for CLI actions.

{: .note }
Commands must implement [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/CommandInterface.php).



## Command Structure

Commands require one public method:

- `public function execute(Centum\Interfaces\Console\TerminalInterface $terminal): int`
  The return value is the exit code.

### Exit Codes

Three constants exist to clearly describe an exit code:

- `Centum\Interfaces\Console\CommandInterface::SUCCESS = 0`
- `Centum\Interfaces\Console\CommandInterface::FAILURE = 1`
- `Centum\Interfaces\Console\CommandInterface::INVALID = 2`

Within a Command, you can use the `self` keyword (for example: `return self::SUCCESS;`).



## Metadata

Use the [`CommandMetadata`](https://github.com/SidRoberts/centum/blob/main/src/Console/CommandMetadata.php) attribute to define the command’s name and description.
This is separated so that this information can be validated without instantiating the Command.



## Example: Basic Command

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

**Command names** must follow a slug pattern: all lowercase, alphanumeric with dashes, and must begin and end with alphanumeric characters.
Empty names are allowed for default commands (e.g., `php cli.php`).



## Command Arguments

Commands can accept arguments via the CLI:

```bash
php cli.php hello --first-name Sid --loud
```

Declare arguments in the constructor with `string` or `bool` types.
Arguments are converted to camel-case, so `--first-name` becomes `$firstName`.

```php
namespace App\Console\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;

#[CommandMetadata("hello")]
class HelloCommand implements CommandInterface
{
    public function __construct(
        protected readonly string $firstName,
        protected readonly bool $loud
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $message = "Hello {$this->firstName}!";

        if ($this->loud) {
            $message = mb_strtoupper($message);
        }

        $terminal->writeLine($message);

        return self::SUCCESS;
    }
}
```



## Injecting Services

You can inject services from the Container into your command’s constructor:

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

        $terminal->writeLine(
            "The time is now {$now->format("H:i:s")} in {$now->format("e")}."
        );

        return self::SUCCESS;
    }
}
```



## Adding Commands to the Application

Add Commands to the Application using the `addCommand()` method:

```php
use App\Console\Commands\IndexCommand;
use Centum\Interfaces\Console\ApplicationInterface;

/** @var ApplicationInterface $application */

$application->addCommand(IndexCommand::class);
```

The Application will be able to determine Command's name from the `CommandMetadata` attribute.
Commands are processed in the order they are added.
A later Command with the same name will overwrite an earlier one.

If the Command's name is invalid, [`InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/main/src/Console/Exception/InvalidCommandNameException.php) will be thrown.
