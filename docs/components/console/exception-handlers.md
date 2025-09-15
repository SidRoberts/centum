---
layout: default
title: Exception Handlers
parent: Console
grand_parent: Components
permalink: console/exception-handlers
nav_order: 4
---



# Exception Handlers

Exception Handlers allow you to catch and handle exceptions that occur during command execution in your Centum console application.

{: .note }
Exception Handlers must implement [`Centum\Interfaces\Console\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/ExceptionHandlerInterface.php).

Exception Handlers require the following public method:

- `public function handle(Centum\Interfaces\Console\TerminalInterface $terminal, Throwable $throwable): void`

You can register multiple Exception Handlers for different exception types.

If an Exception Handler is unsuitable for a given exception, it should throw [`UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/main/src/Console/Exception/UnsuitableExceptionHandlerException.php) so the application can try the next Exception Handler.



## Example: Handling Command Not Found

Handle situations where a Command is not found by catching [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/main/src/Console/Exception/CommandNotFoundException.php):

```php
use App\Console\ExceptionHandlers\CommandNotFoundExceptionHandler;

$application->addExceptionHandler(
    CommandNotFoundExceptionHandler::class
);
```

```php
namespace App\Console\ExceptionHandlers;

use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\UnsuitableExceptionHandlerException;
use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

class CommandNotFoundExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(TerminalInterface $terminal, Throwable $throwable): void
    {
        if (!($throwable instanceof CommandNotFoundException)) {
            throw new UnsuitableExceptionHandlerException($this);
        }

        $terminal->writeErrorLine("Command not found.");

        $terminal->writeErrorLine(
            sprintf(
                "The application was unable to find a command with the name '%s'.",
                $throwable->getName()
            )
        );
    }
}
```



## Example: Catch-All Exception Handler

Add a catch-all Exception Handler for any other exceptions or errors.
Exception Handlers are processed in the order they are added, so this should be added last:

```php
use App\Console\ExceptionHandlers\ThrowableExceptionHandler;

$application->addExceptionHandler(
    ThrowableExceptionHandler::class
);
```

```php
namespace App\Console\ExceptionHandlers;

use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Throwable;

class ThrowableExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(TerminalInterface $terminal, Throwable $throwable): void
    {
        $terminal->writeErrorLine("An error occurred.");

        $terminal->writeErrorLine(
            get_class($throwable)
        );

        $terminal->writeErrorLine(
            $throwable->getMessage()
        );
    }
}
```



## Good Practices

For user-facing applications, it is **strongly recommended** to provide exception handlers for:

- [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/main/src/Console/Exception/CommandNotFoundException.php)
- `Throwable` (catch-all)
