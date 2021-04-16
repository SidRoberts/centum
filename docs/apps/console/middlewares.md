---
layout: default
title: Middlewares
parent: Console
grand_parent: Apps
---



# Middlewares

Middlewares are run by the Application when it is trying to find a matching Command.
If the Command is found, the Application will run the Middlewares which are able to perform additional checks to determine whether the Command should match or not.
By returning `false` or throwing [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php) in a Middleware, the Application will ignore the Command and assume that it is not suitable for the particular command.

Any Middlewares you create must implement [`Centum\Console\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/Console/MiddlewareInterface.php).

```php
namespace App\Middlewares\Console;

use App\Auth;
use Centum\Console\Command;
use Centum\Console\MiddlewareInterface;
use Centum\Console\Terminal;
use Centum\Container\Container;

class IsLinuxMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, Container $container): bool
    {
        $uname = posix_uname();

        return $uname["sysname"] === "Linux";
    }
}
```

This is useful for when you want to separate the Commands from reusable application logic.
For example, you may want to check that a user is running Linux:

```php
namespace App\Commands;

use App\Middlewares\Console\IsLinuxMiddleware;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class AdministrationCommand extends Command
{
    public function getName(): string
    {
        return "something";
    }

    public function getMiddlewares(): array
    {
        return [
            new IsLinuxMiddleware(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->writeLine("this command is running on linux");

        return 0;
    }
}
```

You can even create Commands with multiple middlewares.
If any of them of fail, the Command will fail to match:

```php
namespace App\Commands;

use App\Middlewares\Console\OneMiddleware;
use App\Middlewares\Console\AnotherMiddleware;
use App\Middlewares\Console\AndAnotherMiddleware;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class SomethingCommand extends Command
{
    public function getName(): string
    {
        return "something";
    }

    public function getMiddlewares(): array
    {
        return [
            new OneMiddleware(),
            new AnotherMiddleware(),
            new AndAnotherMiddleware(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->writeLine("hello");

        return 0;
    }
}
```

The example above will only execute if all 3 middlewares return `true`.
