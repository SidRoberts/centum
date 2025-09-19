---
layout: default
title: Aliases
parent: Container Component
permalink: container/aliases
nav_order: 1
---



# Aliases

In many cases, classes will have typehints for interfaces, rather than concrete classes.
As the Container cannot assume which class to inject, the Alias Manager exists to provide aliases to actual classes.

```php
Centum\Container\AliasManager();
```

{: .callout.info }
[`Centum\Container\AliasManager`](https://github.com/SidRoberts/centum/blob/main/src/Container/AliasManager.php) implements [`Centum\Interfaces\Container\AliasManagerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/AliasManagerInterface.php).

You can obtain the Alias Manager from a Container:

```php
use Centum\Interfaces\Container\ContainerInterface;

/** @var ContainerInterface $container */

$aliasManager = $container->getAliasManager();
```

Aliases can be added using the `add()` method:

```php
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Flash\FormatterInterface;

$aliasManager->add(FormatterInterface::class, HtmlFormatter::class);
```

Now, any call with [`FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php) will return the [`HtmlFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/HtmlFormatter.php) class instead:

```php
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Flash\FormatterInterface;

$alias = $aliasManager->get(FormatterInterface::class); // = HtmlFormatter::class
```

If an alias hasn't been set, then the original class will be returned:

```php
$alias = $aliasManager->get(RandomClass::class); // = RandomClass::class
```

The Container will implicitly handle aliases internally so getting `FormatterInterface` from the Container will now actually return a `HtmlFormatter` object:

```php
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Flash\FormatterInterface;

$formatter = $container->get(FormatterInterface::class); // = HtmlFormatter object
```



## Default Aliases

By default, some aliases have already been set:

| Interface | Class |
| --------- | ----- |
| [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Access/AccessInterface.php) | [`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/main/src/Access/Access.php) |
| [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/ApplicationInterface.php) | [`Centum\Console\Application`](https://github.com/SidRoberts/centum/blob/main/src/Console/Application.php) |
| [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Console/TerminalInterface.php) | [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/main/src/Console/Terminal.php) |
| [`Centum\Interfaces\Cron\CronInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Cron/CronInterface.php) | [`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/main/src/Cron/Cron.php) |
| [`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FlashInterface.php) | [`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Flash.php) |
| [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php) | [`Centum\Flash\Formatter\HtmlFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/HtmlFormatter.php) |
| [`Centum\Interfaces\Flash\StorageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/StorageInterface.php) | [`Centum\Flash\Storage`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Storage.php) |
| [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/GeneratorInterface.php) | [`Centum\Http\Csrf\Generator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Generator.php) |
| [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/StorageInterface.php) | [`Centum\Http\Csrf\Storage`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Storage.php) |
| [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/ValidatorInterface.php) | [`Centum\Http\Csrf\Validator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Validator.php) |
| [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/RequestInterface.php) | [`Centum\Http\Request`](https://github.com/SidRoberts/centum/blob/main/src/Http/Request.php) |
| [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/SessionInterface.php) | [`Centum\Http\Session\GlobalSession`](https://github.com/SidRoberts/centum/blob/main/src/Http/Session/GlobalSession.php) |
| [`Centum\Interfaces\Queue\TaskRunnerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/TaskRunnerInterface.php) | [`Centum\Queue\TaskRunner`](https://github.com/SidRoberts/centum/blob/main/src/Queue/TaskRunner.php) |
| [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/RouterInterface.php) | [`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/main/src/Router/Router.php) |
| [`Centum\Interfaces\Translation\TranslatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/TranslatorInterface.php) | [`Centum\Translation\Translator`](https://github.com/SidRoberts/centum/blob/main/src/Translation/Translator.php) |
| [`Centum\Interfaces\Url\UrlInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Url/UrlInterface.php) | [`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/main/src/Url/Url.php) |
