---
layout: default
title: Commands
parent: Console
nav_order: 1
---



# Commands

A Command is responsible for providing the command name (`getName()`), any middlewares (`getMiddlewares()`), parameter filters (`getFilters()`), and the actual code to run (`execute()`).
It's return value is the exit code.

By default, a Command has no middlewares or parameter filters and can be as simple as this:

```php
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
