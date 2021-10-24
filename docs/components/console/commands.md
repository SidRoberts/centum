---
layout: default
title: Commands
parent: Console
grand_parent: Components
nav_order: 1
---



# Commands

A Command is responsible for providing the command name (`getName()`), any middlewares (`getMiddlewares()`), parameter filters (`getFilters()`), and the actual code to run (`execute()`).
It's return value is the exit code.

By default, a Command has no middlewares or parameter filters and can be as simple as this:

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class IndexCommand extends Command
{
    public function getName(): string
    {
        return "this:is:your:name";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        $terminal->writeLine("hello");

        return 0;
    }
}
```



## Adding Commands to the Application

Commands can be added to the Application, using the `addCommand()` method:

```php
use App\Commands\IndexCommand;
use Centum\Console\Application;
use Centum\Container\Container;

$console = new Container();

$console = new Application($container);

$console->addCommand(new IndexCommand());
```

The Application will be able to determine Command's name from the Command's `getName()` method.
Commands are processed in the order that they are added to the Application but a later added Command can overwrite an older Command with the same name.