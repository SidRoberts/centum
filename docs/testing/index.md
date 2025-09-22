---
layout: default
title: Testing
has_children: true
permalink: testing
nav_order: 101
---



# Testing

## [`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Module.php)

Centum uses [Codeception](https://codeception.com/) for most of its testing and utilises its own module ([`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Module.php)) to enable tests to use a centralised [Container](components/container/index.md) object.

This module is already enabled in [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).
You can also enable it in your own projects:

```yaml
modules:
  enabled:
    - Centum\Codeception\Module:
        container: config/container.php
```

Currently, the only config setting is `container` which should link to a file that returns a [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ContainerInterface.php) object.
If this isn't specified, it will default to `config/container.php`.

This module is kept as simple as possible so that it can work with all kinds of tests.
These methods are available in your Tester classes (`tests/Support/UnitTester.php`, for example):

- `makeNewContainer(): void`
- `grabContainer(): Centum\Interfaces\Container\ContainerInterface`
- `mock(class-string $class, callable $callable = null): Mockery\MockInterface`



## Traits

To futher enhance testing, these traits are available in the `Centum\Codeception\Actions` namespace:

- [`AccessActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/AccessActions.php)
- [`AjaxActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/AjaxActions.php)
- [`ConsoleActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/ConsoleActions.php)
- [`ContainerActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/ContainerActions.php)
- [`CookieActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/CookieActions.php)
- [`CsrfActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/CsrfActions.php)
- [`FilterActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/FilterActions.php)
- [`HeaderActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/HeaderActions.php)
- [`HtmlActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/HtmlActions.php)
- [`HttpFormActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/HttpFormActions.php)
- [`JsonActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/JsonActions.php)
- [`QueueActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/QueueActions.php)
- [`RouterActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/RouterActions.php)
- [`RouterReplacementActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/RouterReplacementActions.php)
- [`SessionActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/SessionActions.php)
- [`UnitTestActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/UnitTestActions.php)
- [`ValidatorActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/ValidatorActions.php)

These traits can be used at will in your Tester classes (`tests/Support/UnitTester.php`, for example).
