---
layout: default
title: Commands
parent: Console
nav_order: 1
---



# Commands

A Command is responsible for providing the command name (`getName()`), any middlewares (`getMiddlewares()`), parameter converters (`getConverters()`), and the actual code to run (`execute()`).
It's return value is the exit code.

By default, a Command has no middlewares or parameter converters and can be as simple as this:

```php
use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

class IndexCommand extends Command
{
    public function getName() : string
    {
        return "this:is:your:name";
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        $terminal->writeLine("hello");

        return 0;
    }
}
```
