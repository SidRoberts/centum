---
layout: default
title: Aliases
parent: Container
grand_parent: Components
permalink: container/aliases
nav_order: 1
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

| Interface | Class |
| --------- | ----- |
| [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/AccessInterface.php) | [`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/development/src/Access/Access.php) |
| [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ApplicationInterface.php) | [`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php) |
| [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/TerminalInterface.php) | [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) |
| [`Centum\Interfaces\Cron\CronInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Cron/CronInterface.php) | [`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/development/src/Cron/Cron.php) |
| [`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FlashInterface.php) | [`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash.php) |
| [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FormatterInterface.php) | [`Centum\Flash\Formatter\HtmlFormatter`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Formatter/HtmlFormatter.php) |
| [`Centum\Interfaces\Flash\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/StorageInterface.php) | [`Centum\Flash\Storage`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Storage.php) |
| [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/GeneratorInterface.php) | [`Centum\Http\Csrf\Generator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Generator.php) |
| [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/StorageInterface.php) | [`Centum\Http\Csrf\Storage`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Storage.php) |
| [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/ValidatorInterface.php) | [`Centum\Http\Csrf\Validator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Validator.php) |
| [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php) | [`Centum\Http\Request`](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) |
| [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/SessionInterface.php) | [`Centum\Http\Session\GlobalSession`](https://github.com/SidRoberts/centum/blob/development/src/Http/Session/GlobalSession.php) |
| [`Centum\Interfaces\Queue\TaskRunnerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/TaskRunnerInterface.php) | [`Centum\Queue\TaskRunner`](https://github.com/SidRoberts/centum/blob/development/src/Queue/TaskRunner.php) |
| [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/RouterInterface.php) | [`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/development/src/Router/Router.php) |
| [`Centum\Interfaces\Url\UrlInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Url/UrlInterface.php) | [`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/development/src/Url/Url.php) |
