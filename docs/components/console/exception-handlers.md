---
layout: default
title: Exception Handlers
parent: Console
grand_parent: Components
permalink: console/exception-handlers
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Commands.

Exception Handlers can be used to handle situations where no command is found by handling [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php):

```php
use App\Commands\ErrorCommand;
use Centum\Console\Exception\CommandNotFoundException;

$application->addExceptionHandler(
    CommandNotFoundException::class,
    new ErrorCommand()
);
```

Other Exception Handlers could be added to handle specific Exception classes:

```php
use App\Commands\ErrorCommand;
use Twig\Error\Error;

$application->addExceptionHandler(
    Error::class,
    new ErrorCommand()
);
```

As all Exceptions and Errors extend the `Throwable` class, this example will catch any other Exceptions/Errors.
Take note that exception handlers are processed in the order that they are added so this should be the very last handler:

```php
use App\Commands\ErrorCommand;
use Throwable;

$router->addExceptionHandler(
    Throwable::class,
    new ErrorCommand()
);
```

Error commands can access the Exception through the Container:

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Throwable;

class ErrorCommand extends Command
{
    public function getName(): string
    {
        return "error";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->writeLine("An error occurred.");

        $throwable = $container->typehintClass(Throwable::class);

        $terminal->writeLine(
            get_class($throwable)
        );

        $terminal->writeLine(
            $throwable->getMessage()
        );

        return 0;
    }
}
```



## Good Practices

Depending on your use case, it may not be desired to have exception handlers but for user facing applications, it is **strongly recommended** to have exception handlers for:

- [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)
- `Throwable`
