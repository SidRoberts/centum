---
layout: default
title: Exception Handlers
parent: Console
grand_parent: Components
permalink: console/exception-handlers
nav_order: 4
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Commands.

Exception Handlers can be used to handle situations where no command is found by handling [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php):

```php
use App\Commands\ErrorCommand;
use Centum\Console\Exception\CommandNotFoundException;

$application->addExceptionHandler(
    CommandNotFoundException::class,
    ErrorCommand::class
);
```

Other Exception Handlers could be added to handle specific Exception classes:

```php
use App\Commands\ErrorCommand;
use Twig\Error\Error;

$application->addExceptionHandler(
    Error::class,
    ErrorCommand::class
);
```

As all Exceptions and Errors extend the `Throwable` class, this example will catch any other Exceptions/Errors.
Take note that exception handlers are processed in the order that they are added so this should be the very last handler:

```php
use App\Commands\ErrorCommand;
use Throwable;

$application->addExceptionHandler(
    Throwable::class,
    ErrorCommand::class
);
```

Error commands can access the Exception through the Container:

```php
namespace App\Commands;

use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

class ErrorCommand implements CommandInterface
{
    public function __construct(
        protected readonly Throwable $throwable
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $terminal->writeErrorLine("An error occurred.");

        $terminal->writeErrorLine(
            get_class($this->throwable)
        );

        $terminal->writeErrorLine(
            $this->throwable->getMessage()
        );

        return self::FAILURE;
    }
}
```



## Good Practices

Depending on your use case, it may not be desired to have exception handlers but for user-facing applications, it is **strongly recommended** to have exception handlers for:

- [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)
- `Throwable`
