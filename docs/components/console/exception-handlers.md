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

{: .note }
Exception Handlers must implement [`Centum\Interfaces\Console\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ExceptionHandlerInterface.php).

Exception Handlers only require the following public method:

- `public function handle(Centum\Interfaces\Console\TerminalInterface $terminal, Throwable $throwable): void`

Multiple Exception Handlers can be added to a Console Application and can be used to handle different types of Exceptions.
Within the `handle()` method, an [`Centum\Console\Exception\UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/UnsuitableExceptionHandlerException.php) can be thrown so that the Application can try another Exception Handler instead.

Exception Handlers can be used to handle situations where no command is found by handling [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php):

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

In the case that other Exception Handlers are unsuitable for a particular Exception, this example will act as a catch-all for any other Exceptions/Errors.
Exception Handlers are processed in the order that they are added to the Application so this should be the very last Exception Handler:

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

Depending on your use case, it may not be desired to have exception handlers but for user-facing applications, it is **strongly recommended** to have exception handlers for:

- [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)
- `Throwable`
