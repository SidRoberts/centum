---
layout: default
title: Aliases
parent: Container
grand_parent: Components
permalink: container/aliases
---



# Aliases

Aliases can be added using the `addAlias()` method.
This is particularly useful for interfaces that cannot be directly instantiated:

```php
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Flash\FormatterInterface;

$container->addAlias(
    FormatterInterface::class,
    HtmlFormatter::class
);
```

Now, any call to [`FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FormatterInterface.php) will return or create a new [`HtmlFormatter`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Formatter/HtmlFormatter.php) object.

By default, some aliases have already been set:

| Interface                                        | Class                        |
| ------------------------------------------------ | ---------------------------- |
| `Centum\Interfaces\Access\AccessInterface`       | `Centum\Access\Access`       |
| `Centum\Interfaces\Console\ApplicationInterface` | `Centum\Console\Application` |
| `Centum\Interfaces\Console\TerminalInterface`    | `Centum\Console\Terminal`    |
| `Centum\Interfaces\Container\ContainerInterface` | `$this`                      |
| `Centum\Interfaces\Cron\CronInterface`           | `Centum\Cron\Cron`           |
| `Centum\Interfaces\Flash\FlashInterface`         | `Centum\Flash\Flash`         |
| `Centum\Interfaces\Http\Csrf\GeneratorInterface` | `Centum\Http\Csrf\Generator` |
| `Centum\Interfaces\Http\Csrf\StorageInterface`   | `Centum\Http\Csrf\Storage`   |
| `Centum\Interfaces\Http\Csrf\ValidatorInterface` | `Centum\Http\Csrf\Validator` |
| `Centum\Interfaces\Http\RequestInterface`        | `Centum\Http\Request`        |
| `Centum\Interfaces\Http\SessionInterface`        | `Centum\Http\GlobalSession`  |
| `Centum\Interfaces\Router\RouterInterface`       | `Centum\Router\Router`       |
| `Centum\Interfaces\Queue\TaskRunnerInterface`    | `Centum\Queue\TaskRunner`    |
| `Centum\Interfaces\Url\UrlInterface`             | `Centum\Url\Url`             |
