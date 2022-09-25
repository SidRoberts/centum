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
use Centum\Flash\FormatterInterface;
use Centum\Flash\Formatter\HtmlFormatter;

$container->addAlias(
    FormatterInterface::class,
    HtmlFormatter::class
);
```

Now, any call to [`FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Flash/FormatterInterface.php) will return or create a new [`HtmlFormatter`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Formatter/HtmlFormatter.php) object.

By default, some aliases have already been set:

- [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php): [`Centum\Container\Container`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php)
[`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash/FormatterInterface.php): [`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash.php)
- `Pheanstalk\Contract\PheanstalkInterface`: `Pheanstalk\Pheanstalk`
