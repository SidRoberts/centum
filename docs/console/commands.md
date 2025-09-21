---
layout: default
title: Commands
parent: Console Component
permalink: console/commands
nav_order: 1
---



# Commands

A Command in Centum functions similarly to a Controller in a web application, providing an entry point for CLI actions.

{: .callout.info }
Commands must implement [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/CommandInterface.php).



## Command Structure

Commands require one public method:

- `execute(Centum\Interfaces\Console\TerminalInterface $terminal): int`
  This method is invoked when the command runs, and its return value is used as the exit code.

### Exit Codes

Exit codes are the way your command communicates success or failure back to the operating system or to other programs that may call it.
They are integers in the range **0–255**.

- An exit code of `0` is universally understood as “success”.
- Non-zero values indicate some kind of error or exceptional condition, with different numbers often used to represent different types of problems.

Centum provides three predefined constants to make your code clearer and more self-documenting:

- `Centum\Interfaces\Console\CommandInterface::SUCCESS = 0`
- `Centum\Interfaces\Console\CommandInterface::FAILURE = 1`
- `Centum\Interfaces\Console\CommandInterface::INVALID = 2`

Within a Command, you can use the `self` keyword (for example: `return self::SUCCESS;`).

If needed, you are free to use any integer between `0` and `255` as an exit code, though sticking to the defined constants will keep your commands easier to read and maintain.



## Metadata

Use the [`CommandMetadata`](https://github.com/SidRoberts/centum/blob/main/src/Console/CommandMetadata.php) attribute to define the command’s name and description.
This separation of metadata allows Centum to validate and register commands without instantiating them first, improving performance and flexibility.



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
You can also use a colon to group similar Commands together.
Empty names are permitted for default commands (e.g., `php bin/console` without arguments).



## Command Arguments

Commands can accept arguments via the CLI:

```bash
php bin/console hello --first-name Sid --loud
```

Declare arguments in the constructor with `string` or `bool` types.
Arguments are automatically converted to camel case, so `--first-name` becomes `$firstName`.

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

You can inject services from the Container into your command’s constructor.
This makes it possible to use application services directly in your command without having to manage them manually.

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

Commands must be registered with the Application before they can be used.
You do this with the `addCommand()` method:

```php
use App\Console\Commands\HelloCommand;
use Centum\Interfaces\Console\ApplicationInterface;

/** @var ApplicationInterface $application */

$application->addCommand(HelloCommand::class);
```

The Application determines a Command’s name from the `CommandMetadata` attribute.
Commands are processed in the order they are added, and if two commands share the same name, the later one will overwrite the earlier.

If a Command has an invalid name, an [`InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/main/src/Console/Exception/InvalidCommandNameException.php) will be thrown.
