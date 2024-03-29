---
layout: default
title: Testing
nav_order: 4
has_children: true
permalink: testing
---



# Testing

## [`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)

Centum uses [Codeception](https://codeception.com/) for most of its testing and utilises its own module ([`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)) to enable tests to use a centralised [Container](components/container/index.md) object.

This module is already enabled in [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).
You can also enable it in your own projects:

```yaml
modules:
  enabled:
    - Centum\Codeception\Module:
        container: config/container.php
```

Currently, the only config setting is `container` which should link to a file that returns a [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php) object.
If this isn't specified, it will default to `config/container.php`.

This module is kept as simple as possible so that it can work with all kinds of tests.
These methods are available in your Tester classes (`tests/Support/UnitTester.php`, for example):

- `makeNewContainer(): void`
- `grabContainer(): Centum\Interfaces\Container\ContainerInterface`
- `mock(class-string $class, callable $callable = null): Mockery\MockInterface`



## Traits

To futher enhance testing, these traits are available:

- [`Centum\Codeception\Actions\AccessActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AccessActions.php)
- [`Centum\Codeception\Actions\AjaxActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AjaxActions.php)
- [`Centum\Codeception\Actions\ConsoleActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ConsoleActions.php)
- [`Centum\Codeception\Actions\ContainerActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ContainerActions.php)
- [`Centum\Codeception\Actions\CookieActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/CookieActions.php)
- [`Centum\Codeception\Actions\CsrfActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/CsrfActions.php)
- [`Centum\Codeception\Actions\FilterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/FilterActions.php)
- [`Centum\Codeception\Actions\HeaderActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HeaderActions.php)
- [`Centum\Codeception\Actions\HtmlActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HtmlActions.php)
- [`Centum\Codeception\Actions\HttpFormActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HttpFormActions.php)
- [`Centum\Codeception\Actions\JsonActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/JsonActions.php)
- [`Centum\Codeception\Actions\QueueActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/QueueActions.php)
- [`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)
- [`Centum\Codeception\Actions\RouterReplacementActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterReplacementActions.php)
- [`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)
- [`Centum\Codeception\Actions\UnitTestActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/UnitTestActions.php)
- [`Centum\Codeception\Actions\ValidatorActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ValidatorActions.php)

These traits can be used at will in your Tester classes (`tests/Support/UnitTester.php`, for example).
