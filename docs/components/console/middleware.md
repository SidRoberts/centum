---
layout: default
title: Middleware
parent: Console
grand_parent: Components
permalink: console/middleware
---



# Middleware

Middleware is run by the Application when it is trying to find a matching Command.
If the Command is found, the Application will run the Middleware which is able to perform additional checks to determine whether the Command should match or not.

By returning `false` or throwing [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php) in a Middleware, the Application will ignore the Command and assume that it is not suitable for the particular command.

Any Middlewares you create must implement [`Centum\Interfaces\Console\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/MiddlewareInterface.php).

```php
namespace App\Middlewares\Console;

use App\Auth;
use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class IsLinuxMiddleware implements MiddlewareInterface
{
    public function middleware(Terminal $terminal, Command $command, ContainerInterface $container): bool
    {
        $uname = posix_uname();

        return $uname["sysname"] === "Linux";
    }
}
```

Middlewares are useful for when you want to separate the Commands from reusable application logic.
For example, you may want to check that a user is running Linux:

```php
namespace App\Commands;

use App\Middlewares\Console\IsLinuxMiddleware;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class AdministrationCommand extends Command
{
    public function getName(): string
    {
        return "something";
    }

    public function getMiddleware(): MiddlewareInterface
    {
        return new IsLinuxMiddleware();
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $terminal->writeLine("this command is running on linux");

        return 0;
    }
}
```



## Multiple Middlewares

Commands can be created with multiple middlewares by grouping them within a [`MiddlewareGroup`](https://github.com/SidRoberts/centum/blob/development/src/Console/MiddlewareGroup.php) object.
If any of them of fail, the Command will fail to match:

```php
namespace App\Commands;

use App\Middlewares\Console\Middleware1;
use App\Middlewares\Console\Middleware2;
use App\Middlewares\Console\Middleware3;
use Centum\Console\Command;
use Centum\Console\MiddlewareGroup;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Container\ContainerInterface;

class SomethingCommand extends Command
{
    public function getName(): string
    {
        return "something";
    }

    public function getMiddleware(): MiddlewareInterface
    {
        return new MiddlewareGroup(
            [
                new Middleware1(),
                new Middleware2(),
                new Middleware3(),
            ]
        );
    }

    public function execute(Terminal $terminal, ContainerInterface $container, Parameters $parameters): int
    {
        $terminal->writeLine("hello");

        return 0;
    }
}
```

The example above will only execute if all 3 middlewares return `true`.
